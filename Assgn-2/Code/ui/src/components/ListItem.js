import React, { Component } from 'react';

class Item extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="formC">
                <div className="left">
                    <label>{this.props.hg}:</label>
                </div>
                <div className="left">
                    <label>{this.props.hgField}</label>
                </div>
            </div>
        );
    }
}

export default Item;