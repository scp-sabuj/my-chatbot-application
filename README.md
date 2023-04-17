<h4 align="center"><a href="https://laravel.com" target="_blank">MyChatBot</a></h4>

## About MyChatBot

This is a customer support chatbot system using Laravel and MySQL with Naive Bayes or Support Vector Machines (SVM):


-The system is built using Laravel, a PHP web application framework, and MySQL, a relational database management system.
-The system handles user queries and responses.
-This has two main functionalities: training the model and handling user queries.
-The training data, which includes response patterns and labels, is retrieved from the MySQL database(table:trainings).
-The TokenCountVectorizer class is used to tokenize and count words in the response patterns.
-The TfIdfTransformer class is used to convert word counts to TF-IDF values.
-Either the NaiveBayes or SVC class from the Phpml library is used for classification based on the training data.
-The trained model is serialized and saved to a file for future use.
-The handleChat() method in the PublicController retrieves user queries from requests, loads the trained model from the file, and predicts the appropriate response using the model.
-The predicted response is returned as a JSON response.

## How to setup and run
The steps to setup project locally and run

-clone or download the project
-Go to project directory
-open cmd
-Run the command: composer update
-setup .env file for Database
-Run commands: 
php artisan migrate
php artisan storage:link
php artisan db:seed --class=UserSeeder

-Finally run command: php artisan ser
  

