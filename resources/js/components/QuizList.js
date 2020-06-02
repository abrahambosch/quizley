import React, { useState, useEffect} from 'react';
import { Link } from 'react-router-dom';

const axios = window.axios;

function QuizList() {
    const [quizzes, setQuizzes] = useState([]);
    useEffect(() => {
        axios.get('/api/quizzes').then(response => {
            setQuizzes(response.data.data);
        })
    },[]);

    return (
        <div className="card">
            <div className={"card-body"}>
                <h5 className={"card-title"}>Quizzes</h5>
                <div className="row">
                    <div className="col-md-8">
                        {quizzes.map(quiz => {
                            return (
                                <div>
                                    <Link to={`/quizzes/${quiz.id}`} className="item">{quiz.name}</Link>
                                </div>
                            );
                        })}
                    </div>
                </div>
            </div>
        < /div>
    );
}

export default QuizList;
