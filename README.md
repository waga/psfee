# psfee

Command line php app used to calculate fees using external file for input.

# Installation

Composer autoloader is used for autoloading

(in main directory)

```
composer install
```

# Running tests

(in main directory)

```
./vendor/bin/phpunit --bootstrap autoload.php tests
```

# Running calculations
(inside dist directory)
```
php app.php ../input/input.csv
```

input/input.csv - sample input file
