<marquee class="text-danger">Admin login link and credential given in email. 
    To train the model you need to login as a admin. 
    In training sectiion you got an interface to insert question and answer. 
    After that you need to click on refresh button to train the model using selected algorithm. 
    Selected algorithm is in bottom of admin dashboard page.
</marquee>

<div class="accordion" id="accordionDocumentation">
    <div class="accordion-item">
        <h2 class="accordion-header" id="assignment-tropic">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#ass-tropic" aria-expanded="true" aria-controls="ass-tropic">
                Assignment Tropic
            </button>
        </h2>
        <div id="ass-tropic" class="accordion-collapse collapse show" aria-labelledby="assignment-tropic" data-bs-parent="#accordionDocumentation">
            <div class="accordion-body">
                <div class="text-justify">
                    <strong>Project Description:</strong> Develop an AI-based chatbot system that can provide customer support for a product or service. 
                    The chatbot should be able to answer frequently asked questions, resolve customer issues, and provide suggestions and recommendations. 
                    The chatbot should be trained using machine learning algorithms (such as natural language processing or deep learning) and should be able to understand natural language input from customers.
                </div>

                <br>
                <div>
                    <strong>Requirements:</strong>
                    <ul>
                        <li>The chatbot should be designed to interact with customers via a web interface.</li>
                        <li>The chatbot should be able to understand natural language input from customers and provide relevant responses.</li>
                        <li>The chatbot should be trained using machine learning algorithms (such as natural language processing or deep learning) to improve its accuracy and performance.</li>
                        <li>The chatbot should be able to handle multiple customer requests simultaneously and provide personalized responses based on the context of the conversation.</li>
                        <li>The chatbot should be able to learn from customer interactions and improve its performance over time.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="brief-heading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#brief" aria-expanded="false" aria-controls="brief">
                Brief
            </button>
        </h2>
        <div id="brief" class="accordion-collapse collapse" aria-labelledby="brief-heading" data-bs-parent="#accordionDocumentation">
            <div class="accordion-body">
                <p><strong>This is a customer support chatbot system using Laravel and MySQL with Naive Bayes or Support Vector Machines (SVM):</strong></p>
                    
                <br>
                <ul>
                    <li>The system is built using Laravel, a PHP web application framework, and MySQL, a relational database management system.</li>
                    <li>The system handles user queries and responses.</li>
                    <li>This has two main functionalities: training the model and handling user queries.</li>
                    <li>The training data, which includes response patterns and labels, is retrieved from the MySQL database(table:trainings).</li>
                    <li>The TokenCountVectorizer class is used to tokenize and count words in the response patterns.</li>
                    <li>The TfIdfTransformer class is used to convert word counts to TF-IDF values.</li>
                    <li>Either the NaiveBayes or SVC class from the Phpml library is used for classification based on the training data.</li>
                    <li>The trained model is serialized and saved to a file for future use.</li>
                    <li>The handleChat() method in the PublicController retrieves user queries from requests, loads the trained model from the file, and predicts the appropriate response using the model.</li>
                    <li>The predicted response is returned as a JSON response.</li>
                </ul>
                <br>
                <br>
                <strong>Please note that this is a high-level overview and the actual implementation may require additional considerations such as error handling, data validation, and security measures to ensure a production-ready chatbot system.</strong>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="technology-heading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#technology" aria-expanded="false" aria-controls="technology">
                Technology
            </button>
        </h2>
        <div id="technology" class="accordion-collapse collapse" aria-labelledby="technology-heading" data-bs-parent="#accordionDocumentation">
            <div class="accordion-body">
                <p><strong>The technology stack used in the customer support chatbot system includes:</strong></p>
                <br>
                <ul>
                    <li><strong>Laravel: </strong>A PHP web application framework that provides a robust and scalable platform for building web applications.</li>
                    <li><strong>MySQL: </strong>A popular open-source relational database management system that allows for efficient storage and retrieval of data.</li>
                    <li><strong>Phpml: </strong>A PHP machine learning library that provides various machine learning algorithms for tasks such as classification, regression, clustering, and feature extraction.</li>
                    <li><strong>TokenCountVectorizer: </strong>A class from the Phpml library that is used for tokenizing and counting words in the text data for feature extraction.</li>
                    <li><strong>TfIdfTransformer: </strong>A class from the Phpml library that is used for converting word counts to term frequency-inverse document frequency (TF-IDF) values for feature extraction.</li>
                    <li><strong>NaiveBayes or SVC: </strong>Classes from the Phpml library that are used for classification based on the training data. NaiveBayes implements the Naive Bayes algorithm, while SVC implements Support Vector Machines (SVM) algorithm.</li>
                    <li><strong>JSON: </strong>A lightweight data interchange format that is used for returning the predicted response as a JSON response to the user queries.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="working-way-heading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#working-way" aria-expanded="false" aria-controls="working-way">
                How does it work?
            </button>
        </h2>
        <div id="working-way" class="accordion-collapse collapse" aria-labelledby="working-way-heading" data-bs-parent="#accordionDocumentation">
            <div class="accordion-body">
                <p><strong>The customer support chatbot system using Laravel and MySQL with Naive Bayes or Support Vector Machines (SVM) works as follows:</strong></p>
                <br>
                <ul>
                    <li><strong>Data Preparation: </strong>The system retrieves response data from the MySQL database, which includes response patterns (text) and labels (classifications). This data is used as the training data for the machine learning model.</li>
                    <li><strong>Feature Extraction: </strong>The response patterns (text) are tokenized and word counts are calculated using the TokenCountVectorizer class from the Phpml library. This step converts the text data into numerical feature vectors that can be used for training the machine learning model.</li>
                    <li><strong>Feature Transformation: </strong>The word counts are then converted to term frequency-inverse document frequency (TF-IDF) values using the TfIdfTransformer class from the Phpml library. This step helps in normalizing the feature vectors and taking into account the importance of each word in the response patterns.</li>
                    <li><strong>Model Training: </strong>The transformed feature vectors and their corresponding labels are used to train the machine learning model. Either the NaiveBayes or SVC class from the Phpml library is used for classification based on the training data. The trained model is serialized and saved to a file for future use.</li>
                    <li><strong>User Query Handling: </strong>When a user query is received, the handleChat() method in the PublicController retrieves the query from the request and loads the trained model from the saved file.</li>
                    <li><strong>Prediction: </strong>The loaded model is used to predict the appropriate response based on the user query. The query is tokenized, word counts are calculated, and TF-IDF values are transformed using the same steps as in the data preparation phase. Then, the trained model classifies the query into one of the predefined classes (response labels) based on the feature vectors.</li>
                    <li><strong>Response Generation: </strong>The predicted response (text) is returned as a JSON response to the user query, which can be displayed in the chatbot interface or used for further processing.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="algorithms-work-heading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#algorithms-work" aria-expanded="false" aria-controls="algorithms-work">
                How does both the algorithm work?
            </button>
        </h2>
        <div id="algorithms-work" class="accordion-collapse collapse" aria-labelledby="algorithms-work-heading" data-bs-parent="#accordionDocumentation">
            <div class="accordion-body">
                <p><strong>Naive Bayes Algorithm:</strong></p>
                <br>
                <ul>
                    <li><strong>Data Preparation: </strong>The response data, including response patterns (text) and labels (classifications), is retrieved from the MySQL database. This data is used as the training data for the Naive Bayes algorithm.</li>
                    <li><strong>Feature Extraction: </strong>The response patterns (text) are tokenized and word counts are calculated using the TokenCountVectorizer class from the Phpml library. This step converts the text data into numerical feature vectors that represent the frequency of each word in the response patterns.</li>
                    <li><strong>Feature Transformation: </strong>The word counts are then converted to term frequency-inverse document frequency (TF-IDF) values using the TfIdfTransformer class from the Phpml library. This step helps in normalizing the feature vectors and taking into account the importance of each word in the response patterns.</li>
                    <li><strong>Model Training: </strong>The transformed feature vectors and their corresponding labels are used to train the Naive Bayes model using the NaiveBayes class from the Phpml library. The Naive Bayes algorithm calculates the conditional probabilities of each feature (word) given the class (label) based on the training data.</li>
                    <li><strong>User Query Handling: </strong>When a user query is received, the trained Naive Bayes model is loaded and used to predict the appropriate response based on the user query. The query is tokenized, word counts are calculated, and TF-IDF values are transformed using the same steps as in the data preparation phase. Then, the Naive Bayes model classifies the query into one of the predefined classes (response labels) based on the feature vectors.</li>
                    <li><strong>Prediction: </strong>The loaded model is used to predict the appropriate response based on the user query. The query is tokenized, word counts are calculated, and TF-IDF values are transformed using the same steps as in the data preparation phase. Then, the trained model classifies the query into one of the predefined classes (response labels) based on the feature vectors.</li>
                </ul>
                <br>
                <br>
                <p><strong>Support Vector Machines (SVM) Algorithm:</strong></p>
                <br>
                <ul>
                    <li><strong>Data Preparation: </strong>The response data, including response patterns (text) and labels (classifications), is retrieved from the MySQL database. This data is used as the training data for the SVM algorithm.</li>
                    <li><strong>Feature Extraction: </strong>The response patterns (text) are tokenized and word counts are calculated using the TokenCountVectorizer class from the Phpml library. This step converts the text data into numerical feature vectors that represent the frequency of each word in the response patterns.</li>
                    <li><strong>Feature Transformation: </strong>The word counts are then converted to term frequency-inverse document frequency (TF-IDF) values using the TfIdfTransformer class from the Phpml library. This step helps in normalizing the feature vectors and taking into account the importance of each word in the response patterns.</li>
                    <li><strong>Model Training: </strong>The transformed feature vectors and their corresponding labels are used to train the SVM model using the SVC class from the Phpml library. The SVM algorithm finds the optimal hyperplane that separates the different classes (response labels) based on the training data.</li>
                    <li><strong>User Query Handling: </strong>When a user query is received, the trained SVM model is loaded and used to predict the appropriate response based on the user query. The query is tokenized, word counts are calculated, and TF-IDF values are transformed using the same steps as in the data preparation phase. Then, the SVM model classifies the query into one of the predefined classes (response labels) based on the feature vectors.</li>
                    <li><strong>Prediction: </strong>The predicted response (text) is returned as a JSON response to the user query, which can be displayed in the chatbot interface or used for further processing.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="conclusion-heading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#conclusion" aria-expanded="false" aria-controls="conclusion">
                Conclusion
            </button>
        </h2>
        <div id="conclusion" class="accordion-collapse collapse" aria-labelledby="conclusion-heading" data-bs-parent="#accordionDocumentation">
            <div class="accordion-body">
                <p>In conclusion, the customer support chatbot system implemented using Naive Bayes and 
                    Support Vector Machines (SVM) algorithms in Laravel and MySQL can provide an effective solution 
                    for handling customer inquiries and providing support for a product or service. 
                    The Naive Bayes algorithm is a simple and efficient probabilistic classifier 
                    that works well for text classification tasks, while SVM is a powerful and versatile algorithm for 
                    binary classification tasks. The chatbot system can be trained with labeled data to learn from user 
                    interactions and provide accurate responses. With potential future enhancements such as more training 
                    data, fine-tuning of models, NLP capabilities, multi-channel support, integration with backend systems, 
                    and user feedback analysis, the chatbot system can be further improved to deliver 
                    enhanced customer support experiences.
                </p>
            </div>
        </div>
    </div>


    <div class="accordion-item">
        <h2 class="accordion-header" id="future-upgradation-heading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#future-upgradation" aria-expanded="false" aria-controls="future-upgradation">
                Future Upgradation
            </button>
        </h2>
        <div id="future-upgradation" class="accordion-collapse collapse" aria-labelledby="future-upgradation-heading" data-bs-parent="#accordionDocumentation">
            <div class="accordion-body">
                <p>
                    <strong>
                        With the customer support chatbot system implemented using Naive Bayes and 
                        Support Vector Machines (SVM) algorithms, we can potentially expand and enhance 
                        it in the future to offer more advanced features and capabilities. 
                        Some possibilities include:
                    </strong>
                </p>
                <ul>
                    <li><strong>Adding more training data: </strong>The performance of the chatbot system can be improved by providing more training data to the machine learning models. This can help the models learn more about the customer queries and responses, leading to better accuracy and performance.</li>
                    <li><strong>Fine-tuning the models: </strong>We can experiment with hyperparameter tuning or different variations of the Naive Bayes or SVM algorithms to optimize the performance of the models. This may involve adjusting parameters such as the regularization strength, kernel type, or gamma value to achieve better results.</li>
                    <li><strong>Incorporating other machine learning algorithms: </strong>We can explore and integrate other machine learning algorithms into the chatbot system, such as decision trees, random forests, or deep learning models, to further enhance its accuracy and capabilities.</li>
                    <li><strong>Enhancing user interactions: </strong>We can explore incorporating more interactive and dynamic elements in the chatbot system, such as buttons, cards, images, or voice-based interactions, to make the user experience more engaging and interactive.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="helping-website-heading">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#helping-website" aria-expanded="false" aria-controls="helping-website">
                Helping Website
            </button>
        </h2>
        <div id="helping-website" class="accordion-collapse collapse" aria-labelledby="helping-website-heading" data-bs-parent="#accordionDocumentation">
            <div class="accordion-body">
                <p><strong>Some helping website I have used.</strong></p>
                <ul>
                    <li>Youtube</li>
                    <li>Stack Overflow</li>
                    <li>Laravel Official Site</li>
                    <li>Laracast</li>
                    <li>itsolutionstuff</li>
                    <li></li>
                </ul>
            </div>
        </div>
    </div>

</div>