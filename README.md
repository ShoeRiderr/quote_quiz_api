# Ouote quiz api 

This project is backend side for [This project](https://github.com/ShoeRiderr/quote-quiz-frontend).

Before starting the project you should create a MySql database, create .env file and copy the .env.example content to it.

The content of the .env file should looks something like that:
```
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=quote_quiz
DB_USERNAME=quote_quiz_user
DB_PASSWORD="Password"
```
Next you have to go to the terminal and run
```
php dbseed.php
```
After that the app is ready to run. In the command prompt type:
```
php -S 127.0.0.1:8000 -t public
```
Below you can find available routes:
- api/questions : returns all questions without answers
- api/questions-with-answers : returns questions in random order with answers. you can pass limit as parameter to set limit for number of records to fetch
