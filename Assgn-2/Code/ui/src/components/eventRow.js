import React, { Component } from 'react';
import history from '../routes/history';

class EventRow extends Component {
  constructor(props) {
    super(props);

    this.eventDetails = this.eventDetails.bind(this);
  }

  eventDetails(e){
    e.preventDefault();

    console.log("Clicked" + this.props.event.title);

    history.push({
      pathname: "/EventD",
      event: this.props.event
    })
  }

  render() {
    const event = this.props.event;
    return (
      <tr onClick={this.eventDetails}>
        <td>{event.title}</td>
        <td>{event.starttime}</td>
        <td>{event.location}</td>
        <td>{event.type}</td>
        <td>{event.creater}</td>
        <td>{event.attenders.length}</td>
      </tr>
    );
  }
}

export default EventRow;