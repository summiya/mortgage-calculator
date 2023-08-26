<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Simple Mortgage Calculator

This test is for my own assessment, specifically to evaluate my skills in PHP and Laravel.

Build in Laravel

Requirements - 

- Users input loan details: loan amount, interest rate, and loan term. 
- Mortgage supports fixed terms and extra repayments. 
- Generates an amortization schedule:
- Monthly payment breakdown (principal and interest). 
- Covers entire loan term. 
- Header displays loan setup and effective interest rate. 
- Generates schedule for recalculated, shortened loans due to extra payments:
- Displays loan setup and effective interest rate in header.
- It takes input from the user and validates the input both front-end and back-end.

## How to run

1. Download the source code from the GitHub repository. 
2. The project has been containerized using Docker. 
3. Execute the following commands:
4. run **"composer install"** to add the dependencies 
5. Use `"`**make**`"` to build and run the project within a Docker container. 
6. Run `"`**make migrate**`"` to execute migrations. 
7. To halt all containers simultaneously, use `"`**make down**`"`.

We can also run this app using php artisan serve, if we have Mysql client installed locally

## Run test

Use the following command to run the tests:

- use `"`**make test**`"`

## Env file

Please update the .env.example file to configure database connectivity and other application variables.

## Some Todo lists for the same task

Several optimal scenarios have been circulating in my thoughts, yet due to time constraints, I couldn't implement them.

All requests should be handled by jQuery to prevent page reloading.

I utilized DataTables to directly display data from the database. We can enhance performance by implementing caching here. Additionally, for scenarios where loans span more than a year, introducing simple pagination can expedite the process.

I made certain assumptions while incorporating the implementation.



