import React, { Component } from 'react';
import $ from 'jquery';
import history from './routes/history';
import EventTable from './components/eventTable';
import Cookies from "js-cookie";

class Main extends Component {
  constructor(props) {
    super(props);
    this.state = {
      events: [],
      authorised: false,
      sid: ''
    }
    this.registerUser = this.registerUser.bind(this);
    this.loginUser = this.loginUser.bind(this);
    this.logout = this.logout.bind(this);
    this.getEvents = this.getEvents.bind(this);
    this.getPastEvents = this.getPastEvents.bind(this);
    this.getCurrentEvents = this.getCurrentEvents.bind(this);
    this.addEvent = this.addEvent.bind(this);
  }

  componentDidMount(){
    var sid = Cookies.get('user');
    if(sid != null){
      console.log("Here");
      this.setState({
        authorised: true,
        sid: JSON.parse(sid).sid
      });
      this.getEvents(JSON.parse(sid).sid);
    } else {
      sid = '';
      this.getEvents('');
    }
  }

  getEvents(sid){
    $.ajax({
      type: 'GET',
      url: "http://localhost:3001/users/events",
      dataType: 'json',
      cache: false,
      headers:{
        Authorization: sid
      },
      success: function (data) {
        if(data.msg){
          this.setState({
            authorised: false,
            events: []
          })
          Cookies.remove('user');
        } else{
          this.setState({ events: data });
        }
      }.bind(this),
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
    });
  }

  getCurrentEvents(e){
    e.preventDefault();
    var sid = this.state.sid;
    $.ajax({
      type: 'GET',
      url: "http://localhost:3001/users/events",
      dataType: 'json',
      cache: false,
      headers:{
        Authorization: sid
      },
      success: function (data) {
        if(data.msg){
          this.setState({
            authorised: false,
            events: []
          })
          Cookies.remove('user');
          this.getEvents('');
        } else{
          this.setState({ events: data });
        }
      }.bind(this),
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
    });
  }

  getPastEvents(e){
    e.preventDefault();
    var sid = this.state.sid;
    $.ajax({
      type: 'GET',
      url: "http://localhost:3001/users/pastevents",
      dataType: 'json',
      cache: false,
      headers:{
        Authorization: sid
      },
      success: function (data) {
        if(data.msg){
          this.setState({
            authorised: false,
            events: []
          })
          Cookies.remove('user');
          this.getEvents('');
        } else{
          this.setState({ events: data });
        }
      }.bind(this),
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
    });
  }

  registerUser(e){
    e.preventDefault();

    history.push({
      pathname: "/Register"
    });
  }

  loginUser(e){
    e.preventDefault();

    history.push({
      pathname: "/Login"
    });
  }

  addEvent(e){
    e.preventDefault();

    history.push({
      pathname: "/EventA"
    });
  }

  logout(e){
    e.preventDefault();

    Cookies.remove('user');

    $.ajax({
      type: 'GET',
      url: "http://localhost:3001/users/signout",
      dataType: 'json',
      cache: false,
      headers:{
        Authorization: this.state.sid
      },
      success: function (data) {
        if(data.msg === "Logout Successful"){
          this.setState({ authorised: false});
          this.getEvents('');
          console.log(this.state);
        }
        else
          window.alert(data.msg);
      }.bind(this),
      error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
    });
  }



  render() {
    return (
      <div>
        <h1 className="hg">3322 Event Management System</h1>
        {
          this.state.authorised !== true 
          ?
            <div className="hright">
              <button className="btn mb10" onClick={this.registerUser}>Register</button>
              <br></br>
              <button className="btn mb10" onClick={this.loginUser}>Sign In</button>
            </div>
          :
            <div className = "head">
              <div className="hright">
                <button className="btn mb10" onClick={this.logout}>Sign Out</button>
              </div>
              <div className="hleft">
                <button className="btn mb20 ml20" onClick={this.getCurrentEvents}>Current Event</button>
                <button className="btn mb20 ml20" onClick={this.getPastEvents}>Past Event</button>
                <button className="btn mb20 ml20" onClick={this.addEvent}>Add Event</button>
              </div>
          </div>
        }
        <div className="lightbox">
          <h2>Event List</h2>
        </div>
        <div>
          <EventTable
            events = {this.state.events}
          />
        </div>
      </div>
    );
  }
}

export default Main;