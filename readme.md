# Budgeck

[![Build Status](https://travis-ci.org/ctessier/budgeck.svg?branch=master)](https://travis-ci.org/ctessier/budgeck)
[![StyleCI](https://styleci.io/repos/41213910/shield?branch=master)](https://styleci.io/repos/41213910)

Budgeck is a budget monitoring web application build with Laravel 5.1.

## System requirements

Budgeck's system requirements are similar to Laravel 5.1:

- PHP >= 5.6
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- Composer
- MySQL


## Installation

```shell
$ cd budgeck
$ chown -R www-data:www-data ./storage
$ cp .env.example .env
```

Edit the *.env* file to suit your environment (database connection and mail service)

```shell
$ composer install
$ php artisan key:generate
```

## Development

```shell
$ php artisan migrate --seed
$ npm install
$ bower install
$ gulp watch
```

## Production

Set *APP_ENV=production* in *.env* file

```shell
$ php artisan migrate --seed
$ npm install --production
$ bower install --production
$ gulp --production
```

## Language

So far, Budgeck interfaces have been developed in French. English will be implemented later.

To enable the months names to display in French, you must have the following locales installed on your server:
- fr_FR
- fr_FR.UTF-8

To do so, you can run the following commands in your shell:

```shell
$ locale-gen fr_FR
$ locale-gen fr_FR.UTF-8
```

## References

- [Laravel Website](http://laravel.com/)
