Rscine
======

**Web API of a social network for movie makers**

A Symfony project created on October 24, 2015, 12:50 pm.

## Get it running

Install composer dependencies

```bash
composer install
```

Create database, update the database schema and launch fixtures

```bash
sh reload-database.sh
```

Create an api client/secret for oauth

```bash
php bin/console rscine:oauth-server:client:create
```

Finally, clear the cache and set the rights to the cache, logs and sessions directory

```bash
php bin/console cache:clear
sudo chmod -R 777 var/cache var/logs var/sessions
```

Enjoy !