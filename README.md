## To Do List (Live updating)

Project description

There is one-page application project: To Do List (Tasks) table.
There we can to add new task (simple string) and delete. Set task as done (crossed text).
Also in 5 minutes each task will be done automatically. When we add 2 tasks third that was added before will be done. 
(when there is 1 task that is not done, when we add else two tasks, first task will be done automatically)
All logic was made by Laravel functionality in general.

Main using tools:

- Laravel v9.
- Vuejs v3
- Vuetify v3
- Laravel Echo Server
- Socket IO
- Redis (Queue Broadcasting)

Using:

- MVC
- Requests
- Resources
- Observers
- Factories
- Migrations
- other


## Main settings
### Required instalations
Rredis server

    sudo apt-get install php-redis

Npm laravel-echo, socket.io, socket.io-client

    npm install --save laravel-echo socket.io socket.io-client

### .env

    BROADCAST_DRIVER=redis
    CACHE_DRIVER=file
    QUEUE_CONNECTION=redis
    QUEUE_DRIVER=redis
    SESSION_DRIVER=file
    SESSION_LIFETIME=120

    REDIS_CLIENT=predis
    REDIS_HOST=127.0.0.1
    REDIS_PASSWORD=null
    REDIS_PORT=6379

### Libraries warnings

    Socket IO v.4.. was downgrade to 2.4.0

## Running

    php artisan queue:work
    laravel-echo-server start
    npm run dev
