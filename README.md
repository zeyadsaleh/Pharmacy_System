# Pharmacy System

This is a team project that features an online pharmacy system with different roles (Pharmacy Owner, Doctor, Client , Admin) using Laravel. Clients can make orders using an api and orders have a cycle until it reaches the client.

### Team Members:
	Nouran Samy - Zeyad Saleh - Muhammad Aladdin - Ahmed Abdelhamid

### Prerequisites

You should have `node` and `composer` installed. If you don't, install node from [here](https://nodejs.org/) and composer from [here](https://getcomposer.org/download/).

### Installing
1. Download the zipped file and unzip it or Clone it
		```sh
		git clone https://github.com/zeyadsaleh/Pharmacy_System.git
		```
2. cd inside the project
    ```sh
    cd Pharmacy_System
    ```
3.  Run this command to download composer packages
    ```sh
    composer install
    ```
4. Run this command to download node packages
    ```sh
    npm install
    ```
5. Create a copy of your .env file
    ```sh
    cp .env.example .env
    ```
6. Generate an app encryption key
    ```sh
    php artisan key:generate
    ```
7. Create an empty database for our application
8. In the .env file, add database information to allow Laravel to connect to the database
9. Migrate the database
    ```sh
    php artisan migrate
    ```
10. Seed the database
    ```sh
    php artisan db:seed
    ```
11. Run the Schedule
    ```sh
    php artisan schedule:run
    ```
12. Open up the server
    ```sh
    php artisan serve
    ```
13. Open your browser on this url ``` http://localhost:8000```

### License
MIT License

Copyright (c) 2020 OS40

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
