# Budgeck

[![Build Status](https://travis-ci.org/ctessier/budgeck.svg?branch=master)](https://travis-ci.org/ctessier/budgeck)
[![codecov](https://codecov.io/gh/ctessier/budgeck/branch/master/graph/badge.svg)](https://codecov.io/gh/ctessier/budgeck)

Budgeck is a budget monitoring web application build with Laravel 5.1. To use this project, please make a fork.

**This project is still in build phase, therefore, all the functionalities have not yet been developed.**

## System requirements

Budgeck's system requirements are similar to Laravel :

- PHP >= 5.6
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- Composer
- MySQL


## Installation

- Make sure *storage* directory is writable
- Run *cp .env.example .env*
- If you don't use Homestead, edit the environment variables values to connect to your own database
- Run *composer install*
- Run *php artisan key:generate*


## Development

- Run *php artisan migrate --seed*
- Run *npm install*
- Run *bower install*
- Run *gulp watch*


## Production

- Set *APP_ENV=production* in *.env* file
- Run *php artisan migrate --seed*
- Run *npm install --production*
- Run *bower install --production*
- Run *gulp --production*

## Language

So far, Budgeck interfaces have been developed in French. English will be implemented later.

To enable the months names to display in French, you must have the following locales installed on your server:
- fr_FR
- fr_FR.UTF-8

## References

- [Laravel Website](http://laravel.com/)
