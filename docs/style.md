# Shopping Feed Coding Styles

List of required and recommended styles for php apps and libraries.

Please note that :
- Shopping-Feed coding style is based on (PSR-2 standard)[https://www.php-fig.org/psr/psr-2/]
- Shopping-Feed rely on (PSR-4)[https://www.php-fig.org/psr/psr-4/] for files autoloading 

This document only describes Shopping-Feed additional rules. See implemented automated rules: https://github.com/shoppingflux/coding-style-php/blob/master/phpcs/ruleset.xml

Configuration for **PhpStorm** IDE is available on the following repository : https://github.com/shoppingflux/phpstorm-config

## Requirements

### String declaration

Always use single quote « ' » when the content does not require any interpretation.

```php
<?php

# Valid
$hello = 'Hello world !';
$anotherString = "I said : $hello";

# Invalid
$hello = "Hello world !";
$address = $data[0]["address"];
```

### Exception messages

Exception messages must not contains final dot '.'.

```php
<?php

// Correct
new \Exception('Service not found');

// Wrong
new \Exception('Service not found.');
```

### Return statement

An empty line is required before 'return' if the code ahead is not an opening bracket '{'

```php
<?php

$text = 'Hello';

if (true) {
    // Do not jump line if previous is a block
    return $text;
} else {
    // Jump one line otherwise
    $text .= ' World';

    return $text;
}
```

### Method call chain

```php
<?php

// Inline if short
$object->method1()->method2();

// Multi-line when too long
$object
    ->method1()
    ->method2()
    ->method3()
    ->method4();

// On object property, property stay on the same line than object reference
$this->object
    ->method1()
    ->method2()
    ->method3()
    ->method4();
```

### Method line jump declaration

Do not arbitrary jump lines in method declaration : Only jump lines when max line chars is reached.

##### Correct

```php
public function handle(ServerRequestInterface $request, ServerHandlerInterface $handler): void
{
}
```
##### Not correct

```php
// Max line chars was not reached, we should not jump lines between params
public function handle(
    ServerRequestInterface $request,
    ServerHandlerInterface $handler
    ): void
    {
    }
```

### Class naming

If your class use a type, a role or a pattern, you should declare it in the class name.

**Interface**
Interfaces must be suffixed with the word 'Interface'

```php
<?php
namespace Http\Request;
  
interface RequestInterface
{
    public function getBoby();
}
```

**Abstract**
Abstract classes must be prefixed with the word 'Abstract'

```php
<?php
namespace Http\Request;

abstract class AbstractRequest implements RequestInterface
{
    public function getBoby()
    {
        // ...
    }
}
```

**Exception**
Exception classes must be suffixed with the word 'Exception'

```php
<?php
namespace Http\Request;
  
class RequestException extends \Exception
{
}
```

As a rule of thumb, a class implementing a pattern or a design should express it in its name.

Few examples :
- Request**Factory**
- Request**Adapter**
- Request**Proxy**
- Request**Command**
- ...

### Recovering / fetching one or multiple elements

As part of the `Application\Read` layer (but not only), when fetching one or multiple elements, 
we should strive to respect the following naming conventions (similar to what Doctrine does).

```php
namespace ShoppingFeed\ExampleDomain\Application\Read

interface ExampleDomainAccessInterface
{
    // fetch a specific element by ID
    public function fetch(int $id): ?ReadModel

    // fetch one element
    public function fetchBy(CriteriaInterface $criteria): ?ReadModel;
    
    // fetch multiple elements (a collection)
    public function fetchAllBy(CriteriaInterface $criteria): \ShoppingFeed\Paginator\PaginatorAdapterInterface;
}
``` 

### Passing object by reference
Objects are always passed by reference. Using '&' to request to pass it by reference can be confusing

```php
# Valid
function dataDiff(\DateTime $firstDate, \DateTime $secondDate): \DateInterval
{
    return $firstDate->diff($secondDate);
}

# Invalid
function dataDiff(\DateTime &$firstDate, \DateTime &$secondDate): \DateInterval
{
    return $firstDate->diff($secondDate);
}
```

## Recommendations
