import React, { Component } from 'react';
import $ from 'jquery';
import history from './routes/history';
import Cookies from "js-cookie";
import Item from './components/ListItem'

class EventDetails extends Component {
    constructor(props) {
        super(props);
        this.state = {
            event: '',
            authorised: false,
            sid: ''
        }

        this.backMain = this.backMain.bind(this);
        this.registerUser = this.registerUser.bind(this);
        this.loginUser = this.loginUser.bind(this);
        this.logout = this.logout.bind(this);
    }

    componentDidMount() {
        var sid = Cookies.get('user');
        if (sid != null) {
            console.log("Here");
            this.setState({
                authorised: true,
                sid: sid,
                event: this.props.location.event
            });
            console.log(this.props.location);
        } else {
            sid = '';
            this.setState({
                event: this.props.location.event
            })
        }
    }

    backMain(e) {
        e.preventDefault();

        history.push({
            pathname: "/"
        });
    }

    registerUser(e) {
        e.preventDefault();

        history.push({
            pathname: "/Register"
        });
    }

    loginUser(e) {
        e.preventDefault();

        history.push({
            pathname: "/Login"
        });
    }

    logout(e) {
        e.preventDefault();

        Cookies.remove('user');

        $.ajax({
            type: 'GET',
            url: "http://localhost:3001/users/signout",
            dataType: 'json',
            cache: false,
            headers: {
                Authorization: this.state.sid
            },
            success: function (data) {
                this.setState({ authorised: false });
                console.log(this.state);
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
                        <div className="head">
                            <button className="btn mb10" onClick={this.backMain}>Back</button>
                            <button className="btn mb10 ml20 aR" onClick={this.registerUser}>Register</button>
                            <button className="btn mb10 ml20 aR" onClick={this.loginUser}>Sign In</button>
                        </div>
                        :
                        <div className="head">
                            <button className="btn mb10" onClick={this.backMain}>Back</button>
                            <button className="btn mb10 aR" onClick={this.logout}>Sign Out</button>
                        </div>
                }
                {
                    <div className="whitebox">
                        <h3>Event</h3>
                        <Item hg="Title"        hgField={this.state.event.title} />
                        <Item hg="Type"         hgField={this.state.event.type} />
                        <Item hg="Start Time"   hgField={this.state.event.starttime} />
                        <Item hg="End Time"     hgField={this.state.event.endtime} />
                        <Item hg="Location"     hgField={this.state.event.location} />
                        <Item hg="Description"  hgField={this.state.event.description} />
                        <Item hg="Creater"      hgField={this.state.event.creater} />
                    </div>
                }
            </div>
        );
    }
}

export default EventDetails;