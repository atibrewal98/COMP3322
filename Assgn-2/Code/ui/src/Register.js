import React, { Component } from 'react';
import $ from 'jquery';
import Cookies from "js-cookie";
import history from './routes/history';

class Register extends Component {
  constructor(props) {
    super(props);
    this.state = {
      name: '',
      alias: '',
      email: '',
      password: '',
      confirmation: ''
    }
    this.handleNameChange = this.handleNameChange.bind(this);
    this.handleAliasChange = this.handleAliasChange.bind(this);
    this.handleEmailChange = this.handleEmailChange.bind(this);
    this.handlePwdChange = this.handlePwdChange.bind(this);
    this.handleConfChange = this.handleConfChange.bind(this);
    this.registerUser = this.registerUser.bind(this);
  }

  handleNameChange(e){
    e.preventDefault();
    this.setState({
      name: e.target.value
    })
  }

  handleAliasChange(e){
    e.preventDefault();
    this.setState({
      alias: e.target.value
    })
  }

  handleEmailChange(e){
    e.preventDefault();
    this.setState({
      email: e.target.value
    })
  }

  handlePwdChange(e){
    e.preventDefault();
    this.setState({
      password: e.target.value
    })
  }

  handleConfChange(e){
    e.preventDefault();
    this.setState({
      confirmation: e.target.value
    })
  }

  registerUser(e){
    e.preventDefault();

    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

    if(this.state.name === '' || this.state.alias === '' || this.state.email === '' || this.state.password === '' || this.state.confirmation === ''){
      window.alert("Check all values filled");
    } else if(this.state.password !== this.state.confirmation){
      window.alert("Passwords do not match");
    } else if(emailReg.test(this.state.email) === false){
      window.alert("Email format invalid");
    } else {
      $.post('http://localhost:3001/users/register',
      {
        name: this.state.name,
        alias: this.state.alias,
        email: this.state.email,
        password: this.state.password,
        confirmation: this.state.confirmation
      }, function(data, status){
          if(data.msg === ''){
            console.log('Added Successfully');
            Cookies.set('user', {sid: data.sid, user: data.user});
            console.log(Cookies.get('user'));
            history.push({
              pathname: "/"
            });
          } else{
            console.log(data)
            window.alert(data.msg);
          }
        }
      );
    }

    
  }

  render() {
    return (
      <div>
        <h1 className="hg">3322 Event Management System</h1>
        <div className = "whitebox">
          <h3>Create an account</h3>
          <form>
            <div className = "formC">
              <div className = "left">
                <label>Name</label>
              </div>
              <div className = "right">
                <input
                  type="text"
                  className="input"
                  value={this.state.name}
                  onChange={this.handleNameChange}
                />
              </div>
            </div>
            <div className = "formC">
              <div className = "left">
                <label>Alias</label>
              </div>
              <div className = "right">
                <input
                  type="text"
                  className="input"
                  value={this.state.alias}
                  onChange={this.handleAliasChange}
                />
              </div>
            </div>
            <div className = "formC">
              <div className = "left">
                <label>Email</label>
              </div>
              <div className = "right">
                <input
                  type="text"
                  className="input"
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
                  className="input"
                  value={this.state.password}
                  onChange={this.handlePwdChange}
                />
              </div>
            </div>
            <div className = "formC">
              <div className = "left">
                <label>Confirmation</label>
              </div>
              <div className = "right">
                <input
                  type="password"
                  className="input"
                  value={this.state.confirmation}
                  onChange={this.handleConfChange}
                /> 
              </div>
            </div>
            <div className="center">
              <button className="btn" onClick={this.registerUser}>Register</button>
            </div>
          </form>
        </div>
      </div>
    );
  }
}

export default Register;