import React from 'react';
import { HashRouter, Route, Switch } from 'react-router-dom';
import ReactDOM from 'react-dom';
import history from "./history";
import QuizList from "./QuizList";
import QuizForm from "./QuizForm";

function QuizApp() {
    const renderform = () => {
        return <HashRouter history={history}>
            <div className="ui container">
                <Switch>
                    <Route path="/" exact component={QuizList} />
                    <Route path="/quizzes/:id" component={QuizForm} />
                </Switch>
            </div>
        </HashRouter>;
    }
    return (
        <div className="container">
            {renderform()}
        </div>
    );
}

export default QuizApp;

if (document.getElementById('quiz')) {
    ReactDOM.render(<QuizApp />, document.getElementById('quiz'));
}
