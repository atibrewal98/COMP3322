import React, { Component } from 'react';
import $ from 'jquery';
import history from './routes/history';
import Cookies from "js-cookie";
import Item from './components/ListItem'

class EventDetails extends Component {
    constructor(props) {
        super(props);
        this.state = {
            event: {
                type: '',
                title: '',
                starttime: '',
                endtime: '',
                location: '',
                attenders: [''],
                description: '',
                creater: '',
                createrid: '',
                name: '',
                status: ''
            },
            authorised: false,
            sid: '',
            user: '',
            isCreator: false
        }

        this.backMain = this.backMain.bind(this);
        this.registerUser = this.registerUser.bind(this);
        this.loginUser = this.loginUser.bind(this);
        this.logout = this.logout.bind(this);
    }

    componentDidMount() {
        var sid = Cookies.get('user');
        if (this.props.location.event) {
            this.setState({
                event: this.props.location.event
            });

            if (sid != null) {
                this.setState({
                    isCreator: this.props.location.event.createrid === JSON.parse(sid).user
                });
            }
        }
        if (sid != null) {
            this.setState({
                authorised: true,
                sid: JSON.parse(sid).sid,
                user: JSON.parse(sid).user
            });
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
                            <button className="btn mb10 aL" onClick={this.backMain}>Back</button>
                            <button className="btn mb10 ml20 aR" onClick={this.registerUser}>Register</button>
                            <button className="btn mb10 ml20 aR" onClick={this.loginUser}>Sign In</button>
                        </div>
                        :
                        <div className="head">
                            <button className="btn mb10 aL" onClick={this.backMain}>Back</button>
                            <button className="btn mb10 aR" onClick={this.logout}>Sign Out</button>
                        </div>
                }
                <div className="whitebox">
                    {
                        this.state.authorised !== true
                            ?
                            <div>
                                <h3>Event</h3>
                            </div>
                            :
                            this.state.event.createrid === this.state.user
                                ?
                                <div>
                                    <div className="left">
                                        <h3 className="aL">Event</h3>
                                    </div>
                                    <div className="right">
                                        <button className="btn aR">Delete</button>
                                    </div>
                                </div>
                                :
                                this.state.event.attenders.includes(this.state.user)
                                    ?
                                    <div>
                                        <div className="left">
                                            <h3 className="aL">Event</h3>
                                        </div>
                                        <div className="right">
                                            <button className="btn aR">Leave</button>
                                        </div>
                                    </div>
                                    :
                                    <div>
                                        <div className="left">
                                            <h3 className="aL">Event</h3>
                                        </div>
                                        <div className="right">
                                            <button className="btn aR">Join</button>
                                        </div>
                                    </div>
                    }

                    <Item hg="Title" hgField={this.state.event.title} creator={this.state.isCreator} />
                    <Item hg="Type" hgField={this.state.event.type} creator={this.state.isCreator} />
                    <Item hg="Start Time" hgField={this.state.event.starttime} creator={this.state.isCreator} />
                    <Item hg="End Time" hgField={this.state.event.endtime} creator={this.state.isCreator} />
                    <Item hg="Location" hgField={this.state.event.location} creator={this.state.isCreator} />
                    <Item hg="Description" hgField={this.state.event.description} creator={this.state.isCreator} />
                    <Item hg="Creater" hgField={this.state.event.creater} creator={this.state.isCreator} />
                    
                    {
                        this.state.isCreator
                            ?
                            <div className="center">
                                <button className="btn">Update</button>
                            </div>
                            :
                            <div></div>
                    }
                </div>
            </div>
        );
    }
}

export default EventDetails;