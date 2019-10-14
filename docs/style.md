# Shopping Feed Coding Styles

List of required and recommended styles for php apps and libraries.  

## Requirements


## Recommendations

### Recovering / fetching one or multiple elements

As part of the `Application\Read` layer (but not only), when fetching one or multiple elements, we should strive to respect the following naming conventions (similar to what Doctrine does).

```php
namespace ShoppingFeed\ExampleDomain\Read

interface ExampleDomainAccessInterface
{
    // fetch a specific element by ID
    public function fetch(int $id): ?ReadModel

    // fetch one element
    public function fetchOneBy(CriteriaInterface $criteria): ?ReadModel;
    
    // fetch multiple elements (a collection)
    public function fetchAllBy(CriteriaInterface $criteria): \Traversable;
}
``` 