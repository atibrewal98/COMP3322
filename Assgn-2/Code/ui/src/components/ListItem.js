import React, { Component } from 'react';

class Item extends Component {
    constructor(props) {
        super(props);
        this.state = {
            dispText: false
        }

        this.toggleDisp = this.toggleDisp.bind(this);
    }

    toggleDisp(e){
        e.preventDefault();

        if(this.state.dispText){
            this.setState({
                dispText: false
            })
        } else {
            this.setState({
                dispText: true
            })
        }
    }

    render() {
        return (
            <div className="formC">
                {
                    this.props.creator && this.props.hg !== "Creater"
                        ?
                        this.state.dispText
                            ?
                            <div>
                                <div className="col">
                                    <label>{this.props.hg}:</label>
                                </div>
                                <div className="col">
                                    <input
                                        type="text"
                                        className="input"
                                        value={this.props.hgField}
                                        // onChange={this.handlePwdChange}
                                    />
                                </div>
                                <div className="col">
                                    <button className="btnS aRight" onClick = {this.toggleDisp}>Edit</button>
                                </div>
                            </div>
                            :
                            <div>
                                <div className="col">
                                    <label>{this.props.hg}:</label>
                                </div>
                                <div className="col">
                                    <label>{this.props.hgField}</label>
                                </div>
                                <div className="col">
                                    <button className="btnS aRight" onClick = {this.toggleDisp}>Edit</button>
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