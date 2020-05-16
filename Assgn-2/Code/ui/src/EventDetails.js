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
                eventid: '',
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
            isCreator: false,
            title: '',
            type: '',
            starttime: '',
            endtime: '',
            location: '',
            description: ''
        }

        this.backMain = this.backMain.bind(this);
        this.registerUser = this.registerUser.bind(this);
        this.loginUser = this.loginUser.bind(this);
        this.logout = this.logout.bind(this);
        this.deleteEvent = this.deleteEvent.bind(this);
        this.joinEvent = this.joinEvent.bind(this);
        this.leaveEvent = this.leaveEvent.bind(this);
        this.handleEdit = this.handleEdit.bind(this);
        this.updateEvent = this.updateEvent.bind(this);
    }

    componentDidMount() {
        var sid = Cookies.get('user');
        if (this.props.location.event) {
            this.setState({
                event: this.props.location.event,
                title: this.props.location.event.title,
                type: this.props.location.event.type,
                starttime: this.props.location.event.starttime,
                endtime: this.props.location.event.endtime,
                location: this.props.location.event.location,
                description: this.props.location.event.description
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

    handleEdit(e, field){
        e.preventDefault();
        console.log(field, e.target.value);
        if(field === "Title"){
            this.setState({
                title: e.target.value
            });
        } else if (field === "Type"){
            this.setState({
                type: e.target.value
            });
        } else if (field === "Start Time"){
            this.setState({
                starttime: e.target.value
            });
        } else if (field === "End Time"){
            this.setState({
                endtime: e.target.value
            });
        } else if (field === "Location"){
            this.setState({
                location: e.target.value
            });
        } else if (field === "Description"){
            this.setState({
                description: e.target.value
            });
        }
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

    deleteEvent(e){
        e.preventDefault();

        $.ajax({
            type: 'DELETE',
            url: "http://localhost:3001/users/events/"+this.state.event.eventid,
            data: this.state.event.eventid,
            dataType: 'json',
            cache: false,
            headers: {
                Authorization: this.state.sid
            },
            success: function (data) {
                console.log(data);
                if(data.msg === ''){
                    history.push({
                        pathname: "/"
                    })
                } else {
                    window.alert(data.msg);
                    this.setState({
                        authorised: false,
                        user: '',
                        isCreator: false
                    })
                    Cookies.remove('user');
                }
            }.bind(this),
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }

    joinEvent(e){
        e.preventDefault();

        $.ajax({
            type: 'PUT',
            url: "http://localhost:3001/users/events/"+this.state.event.eventid+"/register",
            dataType: 'json',
            data: {
                status: 'join'
            },
            cache: false,
            headers: {
                Authorization: this.state.sid
            },
            success: function (data) {
                console.log(data);
                if(data.msg === ''){
                    history.push({
                        pathname: "/"
                    })
                } else {
                    window.alert(data.msg);
                    this.setState({
                        authorised: false,
                        user: '',
                        isCreator: false
                    })
                    Cookies.remove('user');
                }
            }.bind(this),
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    }

    updateEvent(e){
        e.preventDefault();

        if(this.state.type !== "public" && this.state.type !== "private"){
            window.alert("Incorrect Event Type");
        } else if(this.state.starttime > this.state.endtime) {
            window.alert("End time should be later than Start time");
        } else {
            $.ajax({
                type: 'PUT',
                url: "http://localhost:3001/users/events/"+this.state.event.eventid,
                dataType: 'json',
                data: {
                    title: this.state.title,
                    type: this.state.type,
                    starttime: this.state.starttime,
                    endtime: this.state.endtime,
                    location: this.state.location,
                    description: this.state.description
                },
                cache: false,
                headers: {
                    Authorization: this.state.sid
                },
                success: function (data) {
                    console.log(data);
                    if(data.msg === ''){
                        history.push({
                            pathname: "/"
                        })
                    } else {
                        window.alert(data.msg);
                        this.setState({
                            authorised: false,
                            user: '',
                            isCreator: false
                        })
                        Cookies.remove('user');
                    }
                }.bind(this),
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
    }

    leaveEvent(e){
        e.preventDefault();

        $.ajax({
            type: 'PUT',
            url: "http://localhost:3001/users/events/"+this.state.event.eventid+"/register",
            data: {
                status: 'leave'
            },
            dataType: 'json',
            cache: false,
            headers: {
                Authorization: this.state.sid
            },
            success: function (data) {
                console.log(data);
                if(data.msg === ''){
                    history.push({
                        pathname: "/"
                    })
                } else {
                    window.alert(data.msg);
                    this.setState({
                        authorised: false,
                        user: '',
                        isCreator: false
                    })
                    Cookies.remove('user');
                }
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
                                        <button className="btn aR" onClick = {this.deleteEvent}>Delete</button>
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
                                            <button className="btn aR" onClick = {this.leaveEvent}>Leave</button>
                                        </div>
                                    </div>
                                    :
                                    <div>
                                        <div className="left">
                                            <h3 className="aL">Event</h3>
                                        </div>
                                        <div className="right">
                                            <button className="btn aR" onClick = {this.joinEvent}>Join</button>
                                        </div>
                                    </div>
                    }

                    <Item hg="Title" hgField={this.state.event.title} creator={this.state.isCreator}  handleEdit={this.handleEdit}/>
                    <Item hg="Type" hgField={this.state.event.type} creator={this.state.isCreator} handleEdit={this.handleEdit}/>
                    <Item hg="Start Time" hgField={this.state.event.starttime} creator={this.state.isCreator} handleEdit={this.handleEdit}/>
                    <Item hg="End Time" hgField={this.state.event.endtime} creator={this.state.isCreator} handleEdit={this.handleEdit}/>
                    <Item hg="Location" hgField={this.state.event.location} creator={this.state.isCreator} handleEdit={this.handleEdit}/>
                    <Item hg="Description" hgField={this.state.event.description} creator={this.state.isCreator} handleEdit={this.handleEdit}/>
                    <Item hg="Creater" hgField={this.state.event.creater} creator={this.state.isCreator} handleEdit={this.handleEdit}/>

                    {
                        this.state.isCreator
                            ?
                            <div className="center">
                                <button className="btn" onClick = {this.updateEvent}>Update</button>
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