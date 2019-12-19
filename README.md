Symfony Clothes Shop Project
=====================

Installation instruction
------------

First, clone this repository:

````
git clone https://github.com/GeoDpto/clothes-shop.git
````

Next, you need to install composer requirements.
If you will use it project in prod use flag --nodev.
````
composer install
````

You need to configure your .env file.
Change DB_NAME and DB_PASSWORD for database connection.
Next, you need to create database and migrate migrations.

````
# Create database
php bin/console doctrine:database:create

# Migrations
php bin/console doctrine:migrations:migrate

````

After this steps you may to use this project.

License
-------

[![license](https://img.shields.io/github/license/greeflas/default-project.svg)](LICENSE)

This project is released under the terms of the BSD-3-Clause [license](LICENSE).

Copyright (c) 2019, Usenko Maxim
