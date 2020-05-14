var express = require('express');
var router = express.Router();


router.post('/register', function(req, res, next) {
  res.set({ "Access-Control-Allow-Origin": "http://localhost:3000" });
  var val = req.body;

  var count = 0;

  req.users.find({}, function(err, docs){
    count = docs.length + 1;
  })

  req.users.find({email: val.email}, function(err, docs){
    if(docs.length){
      res.send({msg: "Duplicated user's email address"});
    } else {
      req.session.userid = "userid" + count;
      req.session.save();
      console.log("Session", req.session, req.sessionID, req.session.cookie);

      req.sessionStore.set(req.sessionID, req.session);

      var usr = new req.users({
        userid:       "userid" + count,
        name:         val.name,
        acctname:     val.alias,
        email:        val.email,
        password:     val.password,
        sessionid:    req.sessionID,
        sessiontoken: "s-token" + count
      });
    
      usr.save(function(err, result){
        res.send((err == null) ? {msg: '', sid: result.sessionid, token: result.sessiontoken, user: usr.userid} : {msg: err});
      });
    }
  });
});

router.post('/signin', function(req, res, next) {
  res.set({ "Access-Control-Allow-Origin": "http://localhost:3000" });
  var val = req.body;

  req.users.find({email: val.email}, function(err, docs){
    console.log(docs);
    if(docs.length == 0){
      res.send({msg: "User is not registered"});
    } else if(docs[0].password != val.password){
      res.send({msg: "Unauthorized access"});
    } else{
      req.session.userid = docs[0].userid;
      req.session.save();
      console.log("Session", req.session, req.sessionID, req.session.cookie);

      req.sessionStore.set(req.sessionID, req.session);
      req.users.findByIdAndUpdate(docs[0]._id, {sessionid: req.sessionID}, function(err, docs){
        console.log(docs);
        res.send({msg: "", sid: docs.sessionid, token: docs.sessiontoken, user: docs.userid})
      })
    }
  });
});

router.get('/events', function(req, res, next) {
  res.set({ "Access-Control-Allow-Origin": "http://localhost:3000" });

  var sid = req.headers.authorization;
  var today = new Date();
  var cDate = today.getFullYear() + "-" + ((today.getMonth()+1) < 10 ? "0" : "") + (today.getMonth()+1) + "-" + (today.getDate() < 10 ? "0" : "") + today.getDate();
  cDate = cDate + " " + (today.getHours() < 10 ? "0": "") + today.getHours() + ":" + (today.getMinutes() < 10 ? "0": "") +  today.getMinutes();

  if(sid){
    req.sessionStore.get(sid, function(err, data){
      if(data){
        req.events.find({endtime: {$gt: cDate}, $or: [{type: "public"}, {createrid: data.userid}]}, null, {sort: {starttime: 1}}, function(err, docs){
          res.send(docs);
        });
      }
    });
  } else {
    req.events.find({endtime: {$gt: cDate}, type: 'public'}, null, {sort: {starttime: 1}}, function(err, docs){
      res.send(docs);
    });
  }
});


router.post('/events', function(req, res, next) {
  res.set({ "Access-Control-Allow-Origin": "http://localhost:3000" });

  var sid = req.headers.authorization;
  var val = req.body;
  var count = 0;

  req.events.find({}, function(err, docs){
    count = docs.length + 1;
  });

  if(sid){
    req.sessionStore.get(sid, function(err, data){
      if(data){
        req.users.find({userid: data.userid}, function(err, docs){
          var event = new req.events({
            eventid:      "eventid" + count,
            title:        val.title,
            type:         val.type,
            starttime:    val.starttime,
            endtime:      val.endtime,
            location:     val.location,
            description:  val.description,
            createrid:    docs[0].userid,
            creater:      docs[0].acctname,
            attenders:    [docs[0].userid]
          });

          console.log("Event:", event);

          event.save(function(err, result){
            res.send((err == null) ? {msg: ''} : {msg: err});
          });
        })
      }
    });
  } else {
    res.send({msg: 'Error'});
  }
});


router.get('/pastevents', function(req, res, next) {
  res.set({ "Access-Control-Allow-Origin": "http://localhost:3000" });

  var sid = req.headers.authorization;
  var today = new Date();
  var cDate = today.getFullYear() + "-" + ((today.getMonth()+1) < 10 ? "0" : "") + (today.getMonth()+1) + "-" + (today.getDate() < 10 ? "0" : "") + today.getDate();
  cDate = cDate + " " + (today.getHours() < 10 ? "0": "") + today.getHours() + ":" + (today.getMinutes() < 10 ? "0": "") +  today.getMinutes();

  var final = new Date();
  final.setDate(final.getDate() - 14);
  var fDate = final.getFullYear() + "-" + ((final.getMonth()+1) < 10 ? "0" : "") + (final.getMonth()+1) + "-" + (final.getDate() < 10 ? "0" : "") + final.getDate();
  fDate = fDate + " " + (final.getHours() < 10 ? "0": "") + final.getHours() + ":" + (final.getMinutes() < 10 ? "0": "") +  final.getMinutes();

  console.log(cDate, fDate);

  if(sid){
    req.sessionStore.get(sid, function(err, data){
      if(data){
        req.events.find({$and: [{endtime: {$lt: cDate}}, {endtime: {$gt: fDate}}], $or: [{type: "public"}, {createrid: data.userid}]}, null, {sort: {starttime: -1}}, function(err, docs){
          res.send(docs);
        });
      }
    });
  } else {
    res.send({msg: err});
  }
});

router.get('/signout', function(req, res, next){
  res.set({ "Access-Control-Allow-Origin": "http://localhost:3000" });

  var sid = req.headers.authorization;

  if(sid){
    req.sessionStore.destroy(sid, function(err){
      if(err)
        console.log(err);
    })
  }

  res.send({msg: "Logout Successful"});
});

module.exports = router;
