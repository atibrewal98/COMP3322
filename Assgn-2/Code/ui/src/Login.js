import React, { Component } from 'react';
import $ from 'jquery';
import history from './routes/history';
import Cookies from "js-cookie";

class Login extends Component {
  constructor(props) {
    super(props);
    this.state = {
      email: '',
      password: ''
    }
    this.handleEmailChange = this.handleEmailChange.bind(this);
    this.handlePwdChange = this.handlePwdChange.bind(this);
    this.registerUser = this.registerUser.bind(this);
    this.loginUser = this.loginUser.bind(this);
  }

  handleEmailChange(e){
    this.setState({
      email: e.target.value
    })
  }

  handlePwdChange(e){
    this.setState({
      password: e.target.value
    })
  }

  loginUser(e){
    e.preventDefault();

    if(this.state.email === '' || this.state.password === ''){
      window.alert("Check all values filled");
    }

    $.post('http://localhost:3001/users/signin',
      {
        email: this.state.email,
        password: this.state.password
      }, function(data, status){
        if(data.msg === ''){
          Cookies.set('user', {sid: data.sid, user: data.user});
          console.log(Cookies.get('user'));
          history.push({
            pathname: "/"
          });
        } else{
          console.log(data);
          window.alert(data.msg);
        }
      }
    );
    this.setState({
      password: ''
    });
  }

  registerUser(e){
    e.preventDefault();

    history.push({
      pathname: "/Register"
    });
  }

  render() {
    return (
      <div>
        <h1 className="hg">3322 Event Management System</h1>
        <div className = "whitebox">
          <h3>SIGN IN</h3>
          <form>
            <div className = "formC">
              <div className = "left">
                <label>Email</label>
              </div>
              <div className = "right">
                <input
                  type="text"
                  value={this.state.email}
                  onChange={this.handleEmailChange}
                />
              </div>
            </div>
            <div className = "formC">
              <div className = "left">
                <label>Password</label>
              </div>
              <div className = "right">
                <input
                  type="password"
                  value={this.state.password}
                  onChange={this.handlePwdChange}
                />
              </div>
            </div>
            <div className="center">
              <button className="btn" onClick={this.loginUser}>Sign In</button>
            </div>
          </form>
        </div>
        <h3 className = "hg">Do not have an account?</h3>
        <div className="center">
          <button className="btn" onClick={this.registerUser}>Register</button>
        </div>
      </div>
    );
  }
}

export default Login;