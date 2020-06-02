# Quiz
Software to allow you to create quizes and for users to take them

@author: Abraham Bosch <abrahambosch@gmail.com>


## Objects
- User: a registered user. 
- Quiz: Object to hold the name of the quiz, etc. 
- Question: the question
- QuestionChoice: a possible answer to a question
- QuizAttempt: Header record for when a user takes the quiz
- QuestionAttempt: Holds the answer a user gives to a question.  


### Local Environment
Local environment is using DDEV - a set of useful scripts to manage docker. 
```shell script
ddev start  # start up the development environment
ddev stop   # stip the devenlopment environment
ddev ssh    # ssh into the application 
ddev describe # shows ip addresses, database credentials, etc
```
### Laravel Commands
```shell script
php artisan route:list
```

## Steps used to setup this project
```shell script
composer create-project --prefer-dist laravel/laravel quiz-api
cd quiz-api
ddev config
ddev start
ddev ssh
composer require laravel/ui
php artisan ui react
php artisan ui react --auth
php artisan migrate
php artisan make:model Quiz -mcr
php artisan make:model Question -mcr
php artisan make:model QuestionChoice -mcr
php artisan make:model QuizAttempt -mcr
php artisan make:model QuestionAttempt -mcr
```


### Routes
```text
abrahambosch@quiz-api-web:/var/www/html$ php artisan route:list
+--------+-----------+-------------------------------------------------------------------------------------------------+---------------------------+------------------------------------------------------------------------+--------------+
| Domain | Method    | URI                                                                                             | Name                      | Action                                                                 | Middleware   |
+--------+-----------+-------------------------------------------------------------------------------------------------+---------------------------+------------------------------------------------------------------------+--------------+
|        | GET|HEAD  | /                                                                                               |                           | Closure                                                                | web          |
|        | POST      | api/quizzes                                                                                     | quizzes.store             | App\Http\Controllers\QuizController@store                              | web          |
|        | GET|HEAD  | api/quizzes                                                                                     | quizzes.index             | App\Http\Controllers\QuizController@index                              | web          |
|        | GET|HEAD  | api/quizzes/create                                                                              | quizzes.create            | App\Http\Controllers\QuizController@create                             | web          |
|        | POST      | api/quizzes/{quiz_id}/questions                                                                 | questions.store           | App\Http\Controllers\QuestionController@store                          | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/questions                                                                 | questions.index           | App\Http\Controllers\QuestionController@index                          | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/questions/create                                                          | questions.create          | App\Http\Controllers\QuestionController@create                         | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/questions/{question_id}/question_choices                                  | question_choices.index    | App\Http\Controllers\QuestionChoiceController@index                    | web          |
|        | POST      | api/quizzes/{quiz_id}/questions/{question_id}/question_choices                                  | question_choices.store    | App\Http\Controllers\QuestionChoiceController@store                    | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/questions/{question_id}/question_choices/create                           | question_choices.create   | App\Http\Controllers\QuestionChoiceController@create                   | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/questions/{question_id}/question_choices/{question_choice}                | question_choices.show     | App\Http\Controllers\QuestionChoiceController@show                     | web          |
|        | DELETE    | api/quizzes/{quiz_id}/questions/{question_id}/question_choices/{question_choice}                | question_choices.destroy  | App\Http\Controllers\QuestionChoiceController@destroy                  | web          |
|        | PUT|PATCH | api/quizzes/{quiz_id}/questions/{question_id}/question_choices/{question_choice}                | question_choices.update   | App\Http\Controllers\QuestionChoiceController@update                   | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/questions/{question_id}/question_choices/{question_choice}/edit           | question_choices.edit     | App\Http\Controllers\QuestionChoiceController@edit                     | web          |
|        | DELETE    | api/quizzes/{quiz_id}/questions/{question}                                                      | questions.destroy         | App\Http\Controllers\QuestionController@destroy                        | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/questions/{question}                                                      | questions.show            | App\Http\Controllers\QuestionController@show                           | web          |
|        | PUT|PATCH | api/quizzes/{quiz_id}/questions/{question}                                                      | questions.update          | App\Http\Controllers\QuestionController@update                         | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/questions/{question}/edit                                                 | questions.edit            | App\Http\Controllers\QuestionController@edit                           | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/quiz_attempts                                                             | quiz_attempts.index       | App\Http\Controllers\QuizAttemptController@index                       | web          |
|        | POST      | api/quizzes/{quiz_id}/quiz_attempts                                                             | quiz_attempts.store       | App\Http\Controllers\QuizAttemptController@store                       | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/quiz_attempts/create                                                      | quiz_attempts.create      | App\Http\Controllers\QuizAttemptController@create                      | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/quiz_attempts/{quiz_attempt_id}/question_attempts                         | question_attempts.index   | App\Http\Controllers\QuestionAttemptController@index                   | web          |
|        | POST      | api/quizzes/{quiz_id}/quiz_attempts/{quiz_attempt_id}/question_attempts                         | question_attempts.store   | App\Http\Controllers\QuestionAttemptController@store                   | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/quiz_attempts/{quiz_attempt_id}/question_attempts/create                  | question_attempts.create  | App\Http\Controllers\QuestionAttemptController@create                  | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/quiz_attempts/{quiz_attempt_id}/question_attempts/{question_attempt}      | question_attempts.show    | App\Http\Controllers\QuestionAttemptController@show                    | web          |
|        | PUT|PATCH | api/quizzes/{quiz_id}/quiz_attempts/{quiz_attempt_id}/question_attempts/{question_attempt}      | question_attempts.update  | App\Http\Controllers\QuestionAttemptController@update                  | web          |
|        | DELETE    | api/quizzes/{quiz_id}/quiz_attempts/{quiz_attempt_id}/question_attempts/{question_attempt}      | question_attempts.destroy | App\Http\Controllers\QuestionAttemptController@destroy                 | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/quiz_attempts/{quiz_attempt_id}/question_attempts/{question_attempt}/edit | question_attempts.edit    | App\Http\Controllers\QuestionAttemptController@edit                    | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/quiz_attempts/{quiz_attempt}                                              | quiz_attempts.show        | App\Http\Controllers\QuizAttemptController@show                        | web          |
|        | DELETE    | api/quizzes/{quiz_id}/quiz_attempts/{quiz_attempt}                                              | quiz_attempts.destroy     | App\Http\Controllers\QuizAttemptController@destroy                     | web          |
|        | PUT|PATCH | api/quizzes/{quiz_id}/quiz_attempts/{quiz_attempt}                                              | quiz_attempts.update      | App\Http\Controllers\QuizAttemptController@update                      | web          |
|        | GET|HEAD  | api/quizzes/{quiz_id}/quiz_attempts/{quiz_attempt}/edit                                         | quiz_attempts.edit        | App\Http\Controllers\QuizAttemptController@edit                        | web          |
|        | PUT|PATCH | api/quizzes/{quiz}                                                                              | quizzes.update            | App\Http\Controllers\QuizController@update                             | web          |
|        | DELETE    | api/quizzes/{quiz}                                                                              | quizzes.destroy           | App\Http\Controllers\QuizController@destroy                            | web          |
|        | GET|HEAD  | api/quizzes/{quiz}                                                                              | quizzes.show              | App\Http\Controllers\QuizController@show                               | web          |
|        | GET|HEAD  | api/quizzes/{quiz}/edit                                                                         | quizzes.edit              | App\Http\Controllers\QuizController@edit                               | web          |
|        | GET|HEAD  | api/user                                                                                        |                           | Closure                                                                | api,auth:api |
|        | GET|HEAD  | home                                                                                            | home                      | App\Http\Controllers\HomeController@index                              | web,auth     |
|        | POST      | login                                                                                           |                           | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
|        | GET|HEAD  | login                                                                                           | login                     | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
|        | POST      | logout                                                                                          | logout                    | App\Http\Controllers\Auth\LoginController@logout                       | web          |
|        | GET|HEAD  | password/confirm                                                                                | password.confirm          | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm    | web,auth     |
|        | POST      | password/confirm                                                                                |                           | App\Http\Controllers\Auth\ConfirmPasswordController@confirm            | web,auth     |
|        | POST      | password/email                                                                                  | password.email            | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web          |
|        | POST      | password/reset                                                                                  | password.update           | App\Http\Controllers\Auth\ResetPasswordController@reset                | web          |
|        | GET|HEAD  | password/reset                                                                                  | password.request          | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web          |
|        | GET|HEAD  | password/reset/{token}                                                                          | password.reset            | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web          |
|        | POST      | register                                                                                        |                           | App\Http\Controllers\Auth\RegisterController@register                  | web,guest    |
|        | GET|HEAD  | register                                                                                        | register                  | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
+--------+-----------+-------------------------------------------------------------------------------------------------+---------------------------+------------------------------------------------------------------------+--------------+

```


## Testing
```shell script
php artisan test  # run the tests
php artisan make:test QuizTest
php artisan make:test QuizAttemptsTest

# To setup sqlite for testing environment
touch /var/www/html/database/test.sqlite
php artisan migrate --seed --env=testing  # setup 
php artisan migrate:rollback --env=testing  # to rollback migrations. 

# create factories for the database seeding  
php artisan make:factory QuizFactory --model=Quiz
```



## clearing cache
```shell script
php artisan cache:clear && php artisan route:clear && php artisan config:clear && php artisan view:clear
```
