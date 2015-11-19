# PHP Coding Style

Generator can be found here: http://edorian.github.io/php-coding-standard-generator/#phpmd

### PHP_CodeSniffer

documentation: https://github.com/squizlabs/PHP_CodeSniffer/wiki/Configuration-Options


### Phing Integration

Copy the necessary files located in directory `phing`, then tweak them according the project needs


### PHPStorm integration


Editor -> inspections -> PHP -> PHP CodeSniffer Validation

    - activate if necessary
    - Coding Standard: Custom
    - Select vendor/shoppingfeed/coding-style-php/phpcs as root directory
    - Apply
    
    
Editor -> inspections -> PHP -> PHP Mess Detector validation

    - activate if necessary
    - Coding Standard: custom
    - Custom rulset: select vendor/shoppingfeed/coding-style-php/phpmd/phpmd.xml
    - Apply