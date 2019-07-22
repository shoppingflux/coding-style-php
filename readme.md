# ShoppingFeed PHP Coding Style

Run CS check and fixer against ShoppingFeed coding standards

### Installation

```
composer require shoppingfed/coding-style-php
```

### Usage

Simply run [phpcs](https://github.com/squizlabs/PHP_CodeSniffer) validation (very verbose mode required to follow progression)

```
vendor/bin/sfcs src --progress -vvv
```

Alternatively, you can run [phpcbs](https://github.com/squizlabs/PHP_CodeSniffer/wiki/Fixing-Errors-Automatically) which will fix CS errors before validating the source files

```
vendor/bin/sfcs src --autofix --progress -vvv
```

### Rules

ShoppingFeed rules file is located at [phpcs/ruleset.xml]

To run validation against a other set of rules, specify the standard

```
vendor/bin/sfcs src --standard=PSR2
```