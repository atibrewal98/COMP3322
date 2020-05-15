import React, { Component } from 'react';
import $ from 'jquery';
import Cookies from "js-cookie";
import history from './routes/history';

class EventAdd extends Component {
    constructor(props) {
        super(props);
        this.state = {
            title: '',
            type: 'public',
            starttime: '',
            endtime: '',
            location: '',
            description: '',
            authorised: false,
            sid: ''
        }
        this.handleTitleChange = this.handleTitleChange.bind(this);
        this.handleTypeChange = this.handleTypeChange.bind(this);
        this.handleStartTime = this.handleStartTime.bind(this);
        this.handleEndTime = this.handleEndTime.bind(this);
        this.handleLocationChange = this.handleLocationChange.bind(this);
        this.handleDescChange = this.handleDescChange.bind(this);
        this.addEvent = this.addEvent.bind(this);
    }

    componentDidMount() {
        var sid = Cookies.get('user');
        if (sid != null) {
            console.log("Here");
            this.setState({
                authorised: true,
                sid: JSON.parse(sid).sid
            });
        }
        var today = new Date();
        var cDate = today.getFullYear() + "-" + ((today.getMonth() + 1) < 10 ? "0" : "") + (today.getMonth() + 1) + "-" + (today.getDate() < 10 ? "0" : "") + today.getDate();
        cDate = cDate + " " + (today.getHours() < 10 ? "0" : "") + today.getHours() + ":" + (today.getMinutes() < 10 ? "0" : "") + today.getMinutes();

        this.setState({
            starttime: cDate,
            endtime: cDate
        });
    }

    handleTitleChange(e) {
        e.preventDefault();
        this.setState({
            title: e.target.value
        })
    }

    handleTypeChange(e) {
        e.preventDefault();
        this.setState({
            type: e.target.value
        })
    }

    handleStartTime(e) {
        e.preventDefault();
        this.setState({
            starttime: e.target.value
        })
    }

    handleEndTime(e) {
        e.preventDefault();
        this.setState({
            endtime: e.target.value
        })
    }

    handleLocationChange(e) {
        e.preventDefault();
        this.setState({
            location: e.target.value
        })
    }

    handleDescChange(e) {
        e.preventDefault();
        this.setState({
            description: e.target.value
        })
    }

    addEvent(e) {
        e.preventDefault();


        if (this.state.title === '' || this.state.type === '' || this.state.starttime === '' || this.state.endtime === '' || this.state.location === '' || this.state.description === "") {
            window.alert("Check all values filled");
        } else if(this.state.starttime > this.state.endtime){
            window.alert("End time should be later than Start time");
        } else{
            $.ajax({
                type: 'POST',
                url: "http://localhost:3001/users/events",
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
                    if(data.msg === ""){
                        history.push({
                            pathname: "/"
                        })
                    } else {
                        window.alert(data.msg);
                    }
                }.bind(this),
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
    }

    render() {
        return (
            <div>
                <h1 className="hg">3322 Event Management System</h1>
                <div className="whitebox">
                    <h3>Create an account</h3>
                    <form>
                        <div className="formC">
                            <div className="left">
                                <label>Title</label>
                            </div>
                            <div className="right">
                                <input
                                    type="text"
                                    className="input"
                                    value={this.state.title}
                                    onChange={this.handleTitleChange}
                                />
                            </div>
                        </div>
                        <div className="formC">
                            <div className="left">
                                <label>Type</label>
                            </div>
                            <div className="right">
                                <input
                                    type="radio"
                                    name="public"
                                    value="public"
                                    checked={this.state.type === "public"}
                                    onChange={this.handleTypeChange}
                                /> Public
                                <input
                                    type="radio"
                                    className="ml50"
                                    name="private"
                                    value="private"
                                    checked={this.state.type === "private"}
                                    onChange={this.handleTypeChange}
                                /> Private

                            </div>
                        </div>
                        <div className="formC">
                            <div className="left">
                                <label>Start Time</label>
                            </div>
                            <div className="right">
                                <input
                                    type="text"
                                    className="input"
                                    value={this.state.starttime}
                                    onChange={this.handleStartTime}
                                />
                            </div>
                        </div>
                        <div className="formC">
                            <div className="left">
                                <label>End Time</label>
                            </div>
                            <div className="right">
                                <input
                                    type="text"
                                    className="input"
                                    value={this.state.endtime}
                                    onChange={this.handleEndTime}
                                />
                            </div>
                        </div>
                        <div className="formC">
                            <div className="left">
                                <label>Location</label>
                            </div>
                            <div className="right">
                                <input
                                    type="text"
                                    className="input"
                                    value={this.state.location}
                                    onChange={this.handleLocationChange}
                                />
                            </div>
                        </div>
                        <div className="formC">
                            <div className="left">
                                <label>Description</label>
                            </div>
                            <div className="right">
                                <input
                                    type="text"
                                    className="input"
                                    value={this.state.description}
                                    onChange={this.handleDescChange}
                                />
                            </div>
                        </div>
                        <div className="center">
                            <button className="btn" onClick={this.addEvent}>Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        );
    }
}

export default EventAdd;