var createError = require('http-errors');
var express = require('express');
var path = require('path');
var cookieParser = require('cookie-parser');
var logger = require('morgan');
var session = require('express-session');
var indexRouter = require('./routes/index');
var usersRouter = require('./routes/users');
var sessionStore = new session.MemoryStore();

var db = require('mongoose');
db.connect('mongodb://localhost/project2', { useNewUrlParser: true, useUnifiedTopology: true }, (err) => {
  if (err)
    console.log("MongoDB connection error: " + err);
  else
    console.log("Connected to MongoDB");
});

//Set the Schema
var event = new db.Schema({
  eventid:        String,
  type:           String,
  title:          String,
  starttime:      String,
  endtime:        String,
  location:       String,
  attenders:      [String],
  description:    String,
  creater:        String,
  createrid:      String,
  name:           String,
  status:         String
});

//Create my model
var events = db.model("Event", event);

var user = new db.Schema({
  userid:         String,
  name:           String,
  acctname:       String,
  email:          String,
  password:       String,
  sessionid:      String,
  sessiontoken:   String
});

var users = db.model("User", user);

var app = express();

// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'pug');

app.use(session({
  secret: 'ChudiPadiHai',
  resave: false,
  saveUninitialized: true,
  store: sessionStore
}))

//Setup CORS Middleware
app.use(function (req, res, next) {
  res.setHeader("Access-Control-Allow-Origin", "*");
  res.setHeader("Access-Control-Allow-Methods", "GET,HEAD,OPTIONS,POST,PUT,DELETE");
  res.setHeader("Access-Control-Allow-Headers", "Origin, X-Requested-With, contentType, Content-Type, Accept, Authorization");
  res.setHeader('Access-Control-Allow-Credentials', true);
  next();
});


app.use(logger('dev'));
app.use(express.json());
app.use(express.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

// Make our model accessible to routers
app.use(function (req, res, next) {
  req.events = events;
  req.users = users;
  next();
});

app.use('/', indexRouter);
app.use('/users', usersRouter);


// catch 404 and forward to error handler
app.use(function (req, res, next) {
  next(createError(404));
});

// error handler
app.use(function (err, req, res, next) {
  // set locals, only providing error in development
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};

  // render the error page
  res.status(err.status || 500);
  res.render('error');
});

module.exports = app;
