import React from 'react'; 
import ReactDOM from 'react-dom'; 
import { BrowserRouter as Router } from 'react-router-dom';
import Routes from './routes/routes';
import * as serviceWorker from './serviceWorker';
import './skins/App.css';
 
ReactDOM.render(
  <Router>
    <div className="Register">
      <Routes />
    </div>
  </Router>,   
document.getElementById('root') ); 

serviceWorker.unregister();