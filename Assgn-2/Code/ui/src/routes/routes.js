import React, { Component } from "react";
import { Router, Switch, Route } from "react-router-dom";
import Main from "../App";
import Login from '../Login';
import Register from '../Register';
import EventDetails from '../EventDetails'
import history from './history';

export default class Routes extends Component {
    render() {
        return (
            <Router history={history}>
                <Switch>
                    <Route path="/" exact component={Main} />
                    <Route path="/Register" component={Register} />
                    <Route path="/Login" component={Login} />
                    <Route path ="/EventD" component={EventDetails} />
                </Switch>
            </Router>
        )
    }
}