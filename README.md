# Unit Test Training in PHP
Project for training teammates with unit tests development improvement.

<!-- badges -->
[![Open Source Love](https://badges.frapsoft.com/os/mit/mit.svg?v=102)]()

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
* Running tests with phpunit;
* Running tests with composer;
* Practical examples;

## Concepts not covered
* Command line options;
* Code coverage;
* Logging (test results and coverage);
* Extending the PHPUnit test cases;

## Others 
* Configuring PHP Storm to execute test

## Prerequisites
* PHP 5.6 at least

## Installation
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