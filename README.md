# BabyCare
<p>Simple Laravel API app for baby care solution</p>

## Requirements
 - PHP V8.0^
 - MYSQL V5.7^ 
## Installation
- clone the product repo into your machine
- run `composer install`
- create your database and add it's username, password to `.env` file
- run `php artisan migrate:fresh --seed` to create database tables and run seeds.
- run `php artisan serve` to start local server

## Postman collection
Attached `tests\baby_care.json` [Postman](https://www.postman.com/) collection file, so you can check each endpoint params and response, and also test it yourself
- import `baby_care.json` to **Postman**
- run each request to check responses.
**NOTE** User details are found in `database\factories\UserFactory.php` class

## Endpoints Documentation
Provided `Endpoints.md` file that contains all endpoints documentation and each specification

## Testing
To run all tests, run `php artisan test`, this will run all tests [**feature tests**, **unit tests**].
