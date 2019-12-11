# Unit Test Training in PHP
Project for training teammates with unit tests development improvement.

<!-- badges -->
[![Open Source Love](https://badges.frapsoft.com/os/mit/mit.svg?v=102)]()
[![Build Status](https://travis-ci.org/andersoncontreira/training-unit-test-php.svg?branch=master)](https://travis-ci.org/andersoncontreira/training-unit-test-php)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/ab2e2967641e408498e52117c3e13f26)](https://www.codacy.com/manual/andersoncontreira/training-unit-test-php?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=andersoncontreira/training-unit-test-php&amp;utm_campaign=Badge_Grade)
[![Codacy Badge](https://api.codacy.com/project/badge/Coverage/ab2e2967641e408498e52117c3e13f26)](https://www.codacy.com/manual/andersoncontreira/training-unit-test-php?utm_source=github.com&utm_medium=referral&utm_content=andersoncontreira/training-unit-test-php&utm_campaign=Badge_Coverage)

## Concepts covered
* Basic configuration;
* XML configuration;
* Bootstrap file configuration;
* Composer configuration;
* Basic structure of test cases;
* Test suite elaboration;
* Fixtures;
* Skipping tests;
* Tests with databases;
* Mocks;
* Datasets;
* Data providers;
* Annotations;
* Assertions;
* Code coverage;
* Running tests with phpunit;
* Running tests with composer;
* Logging (test results and coverage);
* Extending the PHPUnit test cases;
* Practical examples;

## Concepts not covered
* Command line options;


## Others 
* Configuring PHP Storm to execute test

## Prerequisites
* PHP 7.1 at least;
* PHPUnit 7.*;
* PDO;
* mysql;
* sqlite3;

## Installation
### Installing PHP Modules
```
sudo apt install php7.1-mysql
sudo apt install php7.1-sqlite3 
```

### Installing packages and dependencies 
To check this project running you can clone it in you workspace and execute the test with `composer`.   
```
composer install
```

## Running tests
To run the unit tests, you can execute the follow command:

```
composer test
```
or 
```
php ./vendor/phpunit/phpunit/phpunit --bootstrap ./tests/bootstrap.php --configuration ./phpunit.xml
```

## Running tests with coverage
```
composer test-coverage
```
or 
```
php ./vendor/phpunit/phpunit/phpunit --bootstrap ./tests/bootstrap.php --configuration ./phpunit.xml --coverage-clover ./target/coverage.xml
```

## Concepts covered
### XML configuration
Describe here this content...

#### Test Suits
Tests suits are an set of codes, for example, a group of codes of a context.
In the configuration file `phpunit.xml` this rule as write as bellow:
```xml
<testsuites>
    <testsuite name="validator-rules">
        <directory>tests/Training/Validators/Rules/</directory>
    </testsuite>
</testsuites>
``` 

### Bootstrap file
Describe here this content...

## Running the unit tests

### Running test suits

Bellow the code will execute the context of Rules of Validation that are registered with the alias `validators-rules`. 
```
php ./vendor/phpunit/phpunit/phpunit --bootstrap ./tests/bootstrap.php --configuration ./phpunit.xml --testsuite validator-rules
```

for more information about test suits please go to [Test Suits](#test-suits). 

## Exercises

Follow the list of topics to you do some exercises:
* Implement the AddressValidator;
* Create the unit test for AddressValidator;  




## Practical examples 
All the files of this project is the example for the training, 
you can find the step-by-step process bellow:<br/>
[Pratical example step-by-step](docs/training/step1.md);


## Docs and references
* [PHPUnit](https://phpunit.readthedocs.io)

## License 
Code released under the [LICENSE](LICENSE)  

## Contributors
[Anderson Contreira](https://github.com/andersoncontreira)

## Contributions 
Pull requests and new issues are welcome. See [CONTRIBUTING.md](CONTRIBUTING.md) for details. 