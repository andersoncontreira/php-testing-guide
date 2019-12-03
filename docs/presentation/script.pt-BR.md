# Roteiro do treinamento

## Configurações do PHP

### Habilitar o XDEBUG
Verificar se o modulo está ativo:

```
php -m
```

Abrir o arquivo da extenção do XDEBUG
```
cd /etc/php.d/
sudo vim 15-xdebug.ini
```

Ativar a extenção do XDEBUG:

```
; Enable xdebug extension module
zend_extension=xdebug.so
;
; see http://xdebug.org/docs/all_settings
xdebug.remote_enable=true
xdebug.remote_port=9000
xdebug.profiler_enable=1
```

Verificar novamente:
```
php -m
```

## Baixar o projeto de exemplo
Fazer o clone do projeto:

### HTTPS
```
git clone https://github.com/andersoncontreira/training-unit-test-php.git
```

### SSH
```
git clone git@github.com:andersoncontreira/training-unit-test-php.git
```

### Instalar dependencias
Executar o composer install
```
composer install
```

## Configuração da IDE PHPStorm

Para facilitar o desenvolvimento vamos configurar a IDE PHPStorm:

### Definir o interpretador do PHP:
Acessar o menu e definir:
> File > Settings > Language e Frameworks > PHP

Definir:
CLI Interpreter = /usr/bin/php


### Configurar o PHPUnit:
Acessar o menu:
> Languages e Frameworks > PHP > Test Framework
+ PHP Unit local

Use composer autoload:
Path: /home/treinamento/Rentclass/training-unit-test-php/vendor/autoload.php

Default configuration file:
/home/treinamento/Rentclass/training-unit-test-php/phpunit.xml

Default bootstrap file:
/home/treinamento/Rentclass/training-unit-test-php/tests/bootstrap.php

## Criando o projeto de treinamento

### Criar o projeto live-rentclass

```
cd ~

mkdir live-rentclass

cd live-rentclass
```

### Iniciar o composer
```
composer init
```

### Instalar as dependencias básicas
```
composer require monolog/monolog:^1.14
composer require fzaninotto/faker:^1.7
composer require --dev phpunit/phpunit:5.7.21
```

### Copiar as classes padrões do projeto



### seguir as etapas
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