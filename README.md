Guidelines:
-------------------
1. Clone the repo
2. Install packages using composer install in the root folder
3. php artisan server - To start the server (will be started at http://localhost:8000)

API endpoints: 
---------------------
1. http://localhost:8000/api/posts
2. http://localhost:8000/api/posts?userId=1
3. http://localhost:8000/api/my-users

I have also created migration scripts in laravel so that the deployment on any new system will be easier.

The sync script to fetch data from the jsonplaceholder website is built as a console command in Laravel.

1. To list commands: php artisan
2. To sync data: php sync:data

I have created multiple tables to store the data received.

1. MyUsers
2. Company
3. Addresses
4. Coordinates
5. Posts
