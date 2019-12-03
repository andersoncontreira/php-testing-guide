# Training - Step 1 - Creating the project
In this step we will create the project with the team.

## Initializing the composer project
Execute the follow command:

```
composer init
```

## Installation
The first step is the installation of `phpunit`, even though it is not installed. The installation is done using the command `composer`:

```
composer require --dev phpunit/phpunit:5.7.21
```
In this project we will use logs, so we need `monolog` too.
```
composer require monolog/monolog:^1.14
```
We need install the `faker` to generate person data for the tests.
```
composer require --dev fzaninotto/faker:^1.7
```

## Creating the first files of the project
Create the folder `src` and `tests`. 

[Next Step](step2.md)

