## Hacker News Clone

<p>This is a practical assessment given by Wunderman Thompson, which consists in making a clone of the Hacker News Website</p>

## Technologies
- Composer version 2.2.6
- PHP v8.1.6 
- MySQL v10.4.24
- Laravel v9
- Bootstrap v5.2
- Jquery v3.6
## How does it work?
- We fetrch the top news, the new news, and the best news, with they own comments and sub comments. 
- Store the data in the local database which is the one that will be displayed on the page

## API endpoints:
|News                 |Endpoint                                                               |
|---------------------|-----------------------------------------------------------------------|
|Top stories          |https://hacker-news.firebaseio.com/v0/topstories.json?print=pretty     |
|Best stories         |https://hacker-news.firebaseio.com/v0/beststories.json?print=pretty    |
|New stories          |https://hacker-news.firebaseio.com/v0/newstories.json?print=pretty     |
|Single story/comment |https://hacker-news.firebaseio.com/v0/item/<ietem_id>.json?print=pretty|

## Setup
1. PHP and MYSQL (You can install XAMMP or any other similar tool)
2. Install composer, 
3. Create a database to store the collected data from the API
4. Download the project(don't forget to extract the zip file) or clone the repository(https://github.com/Benybodipo/Hacker-News-Clone) to your local machine
5. If you clonned the repository, you'll find a .env.example file, copy it and rename it to .env and configure the database
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=youy_database_password
```
Change
```
From: 
QUEUE_CONNECTION=sync
To:
QUEUE_CONNECTION=database
```
6. To install possible external dependencies; from the command line pointing on the root directory run:
``` 
$> composer install 
```
7. Access to the project folder via you command line(CMD) and from the root directory run the following command in sequential order. NOTE: Please wait for each command to complete:
    * **To create the database run:**
    ```
    $> php artisan migrate
    ```
    * **Too seed the database run:**
    ```
    $> php artisan db:seed
    ```

    * In another command line (from the root directory) run the following command to queue the API requests
    ```
    $> php artisan queue:work
    ```
    The first queue will have to comple first in order to have content on the database (Please wait until the 3 queues are completed then proceed to the next step bellow)
    _(The seeding might take a while since it fetches the news and the comment from the different API points)_
    * **To run the schedule/cron that periodically fetches the news from the API, open  other command line from the project root directory and run:**
    ```
    $> php artisan schedule:work
    ```

    NOTE: Please keep both the queue and the schedule commands running at all time in order to get updated news every 5 to 10 minutes

    ## Run the server
    To run the server/application, from the root directory and on the command line, run:
    ```
    $> php artisan serve
    ```
    _The server will be running on [http://127.0.0.1:8000] but you could customise the port if needed (please check laravel documentation)_

