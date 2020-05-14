import React, { Component } from 'react';
import EventRow from './eventRow'

class EventTable extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        var rows = this.props.events.map((event) => {
            return (
                <EventRow
                    event={event}
                    key={event.eventid}
                />
            );
        });
        return (
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Time</th>
                        <th>Venue</th>
                        <th>Type</th>
                        <th>Owner</th>
                        <th>Attenders</th>
                    </tr>
                </thead>
                <tbody>{rows}</tbody>
            </table>
        );
    }
}

export default EventTable;