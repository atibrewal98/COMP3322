import React, { Component } from 'react';

class Item extends Component {
    constructor(props) {
        super(props);
    }

    render() {
        return (
            <div className="formC">
                {
                    this.props.creator
                        ?
                        <div>
                            <div className="col">
                                <label>{this.props.hg}:</label>
                            </div>
                            <div className="col">
                                <label>{this.props.hgField}</label>
                            </div>
                            <div className="col">
                                <button className="btnS aRight">Edit</button>
                            </div>
                        </div>
                        :
                        <div>
                            <div className="left">
                                <label>{this.props.hg}:</label>
                            </div>
                            <div className="right">
                                <label>{this.props.hgField}</label>
                            </div>
                        </div>
                }
            </div>
        );
    }
}

export default Item;