import React, {useEffect, useState} from 'react';
import { Form, Field } from 'react-final-form'
import { Link } from 'react-router-dom';

const Question = props => {
    const {id, question, question_type, choices} = props.question;
    if (question_type === 'SELECT') {
        return (
            <Field name={`question${id}`}>
                {({input, meta}) => (
                    <div className="form-group">
                        <label>{question}</label>
                        <select {...input} className="form-control">
                            <option value={''}></option>
                            {choices.map(choice => (
                                <option value={choice.choice_value} key={choice.id}>{choice.choice}</option>
                            ))}
                        </select>
                        {(meta.error || meta.submitError) && meta.touched && (
                            <div className="red">{meta.error || meta.submitError}</div>
                        )}
                    </div>
                )}
            </Field>
        );
    }
    else {
        return (
            <Field name={`question${id}`}>
                {({input, meta}) => (
                    <div className="form-group">
                        <label>{question}</label>
                        <input {...input} type="text" placeholder="" className="form-control"/>
                        {(meta.error || meta.submitError) && meta.touched && (
                            <div className="red">{meta.error || meta.submitError}</div>
                        )}
                    </div>
                )}
            </Field>
        );
    }
};


function QuizForm(props) {
    const quiz_id = props.match.params.id
    const [quiz, setQuiz] = useState({});
    const [quizStatus, setQuizStatus] = useState("");
    useEffect(() => {
        axios.get(`/api/quizzes/${quiz_id}/questions`).then(response => {
            setQuiz(response.data);
        })
    },[]);

    const onSubmit = formValues => {
        console.log("onSubmit", formValues);
        const question_attempts = quiz.questions.map(question => {
            const name = `question${question.id}`;
            return {
                question_id: question.id,
                answer: formValues[name]
            };
        });
        const data = { quiz_id, question_attempts };
        axios.post(`/api/quizzes/${quiz_id}/quiz_attempts`, data).then(response => {
            setQuizStatus("Success. You have submitted your quiz!");
            setTimeout(()=>{
                history.back();
            }, 2000)
        }).catch(err => {
            console.error(err)
        })
    }

    const validate = (formValues) => {
        let errors = {};
        quiz.questions.forEach(question => {
            const name = `question${question.id}`;
            console.log("looking at name", name, formValues[name])
            if (!formValues[name]) {
                errors[name] = "please answer the question";
            }
        });
        return errors;
    };

    console.log(JSON.stringify(quiz))
    if (!quiz.quiz) return <div></div>;
    return (
        <div className="card">
            <div className={"card-body"}>
                <h5 className={"card-title"}>{quiz.quiz.name}</h5>
                <h6 className="card-subtitle mb-2 text-muted">Description: {quiz.quiz.description}</h6>
                <div className="row">
                    <div className="col-md-12">
                        {quizStatus && (
                            <div className="alert alert-success" role="alert">
                                {quizStatus}
                            </div>
                        )}
                        <Form
                            initialValues={{}}
                            onSubmit={onSubmit}
                            validate={validate}
                            render={({submitError, handleSubmit, form, submitting, pristine, values}) => (
                                <form onSubmit={handleSubmit}>
                                    {quiz.questions.map(question => (
                                        <Question question={question} key={question.id}/>
                                    ))}

                                    {submitError && <div className="error">{submitError}</div>}
                                    <div className="buttons">
                                        <button className={"btn btn-primary"} type="submit" disabled={submitting}>
                                            Submit
                                        </button>
                                        <Link to="/" className={"btn btn-default"} style={{marginLeft: "20px"}} type="submit" disabled={submitting}>
                                            Back
                                        </Link>
                                    </div>
                                </form>
                            )}
                        />
                        {/*<pre>{JSON.stringify(quiz, null, 2)}</pre>*/}
                    </div>
                </div>
            </div>
        </div>
    );
}

export default QuizForm;
