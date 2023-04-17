<h4 align="center"><a href="https://laravel.com" target="_blank">MyChatBot</a></h4>

## About MyChatBot

This is a customer support chatbot system using Laravel and MySQL with Naive Bayes or Support Vector Machines (SVM):


<ul>
    <li>The system is built using Laravel, a PHP web application framework, and MySQL, a relational database management system.</li>
    <li>The system handles user queries and responses.</li>
    <li>This has two main functionalities: training the model and handling user queries.</li>
    <li>The training data, which includes response patterns and labels, is retrieved from the MySQL database(table:trainings).</li>
    <li>The TokenCountVectorizer class is used to tokenize and count words in the response patterns.</li>
    <li>The TokenCountVectorizer class is used to tokenize and count words in the response patterns-The TfIdfTransformer class is used to convert word counts to TF-IDF values.</li>
    <li>Either the NaiveBayes or SVC class from the Phpml library is used for classification based on the training data.</li>
    <li>The trained model is serialized and saved to a file for future use.</li>
    <li>The handleChat() method in the PublicController retrieves user queries from requests, loads the trained model from the file, and predicts the appropriate response using the model.</li>
    <li>The predicted response is returned as a JSON response.</li>
    
</ul>


## How to setup and run
The steps to setup project locally and run.
<div>
<b style="color:red">Befor setup project you have to setup laravel first in your localhost.</b>
</div>
<ul>
    <li>Clone or download the project</li>
    <li>Go to project directory</li>
    <li>
        Open cmd
        <ul>
            <li>Run the command: composer update</li>
        </ul>
    </li>
    <li>setup .env file for Database</li>
    <li>Run Command:
        <ul>
            <li>php artisan migrate</li>
            <li>php artisan storage:link</li>
            <li>php artisan db:seed --class=UserSeeder</li>
            <li>php artisan key:generate</li>  
            <li>composer require php-ai/php-ml</li>
        </ul>
    </li>
    <li>Finally run command: php artisan ser</li>
</ul>
