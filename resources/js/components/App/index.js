import React from 'react';
import ReactDOM from 'react-dom';
import './style.css'; 
import Header from '../Header/index'
import Main from '../Main/index' 


const Index = () => (
    <div className="grid-container">
       <Header></Header>
       <Main></Main>
       <div className="item5">Footer</div>
    </div>
);


export default Index;

if (document.getElementById('app-container')) {
    ReactDOM.render(<Index />, document.getElementById('app-container'));
}
