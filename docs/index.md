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

### Documentation

Generates enabled rules markdown

```
vendor/bin/phpcs  --standard=phpcs/ruleset.xml --generator=Markdown > docs/rules.md
```

### Rules

ShoppingFeed rules file is located at [phpcs/ruleset.xml]

To run validation against a other set of rules, specify the standard

```
vendor/bin/sfcs src --standard=PSR2
```

### Workflow

If you want to update the coding style across ALL Shopping-Feed projects, you’ll have to use this repository.

Here are the steps you have to follow : 

 1. Submit your proposition to a vote : 
    - open an issue on this repository (prefix the name using `[VOTE]`)
    - explain what you are trying to do with examples that illustrate both GOOD and BAD behaviour
    - invite people to vote (all members of the team)
 2. If approved by a simple majority, you’ll need to propose a new PR on this same repository, one that : 
    - updates the readme file with the voted proposition
    - enforces it in the validation rules used by our different tools that make-up our continuous integration pipeline (such as the code sniffer) - this second step is optional