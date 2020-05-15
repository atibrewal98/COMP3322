import React, { Component } from 'react';

class Item extends Component {
    constructor(props) {
        super(props);
        this.state = {
            dispText: false,
            textbox: ''
        }

        this.toggleDisp = this.toggleDisp.bind(this);
        this.handleEdit = this.handleEdit.bind(this);
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

    handleEdit(e){
        e.preventDefault();
        this.props.handleEdit(e, this.props.hg);
        this.setState({
            textbox: e.target.value
        });
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
                                        value={this.state.textbox === '' ? this.props.hgField : this.state.textbox}
                                        onChange={this.handleEdit}
                                    />
                                </div>
                                <div className="col">
                                    <button className="btnS aRight" onClick = {this.toggleDisp}>Save</button>
                                </div>
                            </div>
                            :
                            <div>
                                <div className="col">
                                    <label>{this.props.hg}:</label>
                                </div>
                                <div className="col">
                                    <label>{this.state.textbox === '' ? this.props.hgField : this.state.textbox}</label>
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
                                <label>{this.state.textbox === '' ? this.props.hgField : this.state.textbox}</label>
                            </div>
                        </div>
                }
            </div>
        );
    }
}

export default Item;