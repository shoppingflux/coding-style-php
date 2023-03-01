# shoppingfeed/coding-style-php

### Installation

```
composer require shoppingfeed/coding-style-php
```

### Contributing

To connect to a php 8.0 container correctly configured

- Create a container : `docker run --name coding-style-php -v $PWD:/var/www -d ghcr.io/shoppingflux/php:8.0.2-fpm`
- Connect to container : `docker exec -it coding-style-php bash`

Once connected to the container you can :

- Update composer dependencies : `composer update`
- Run test : `composer test`

### Proposal process

See [proposal](docs/index.md#proposal)

### Documentation

Documentation is driven by [mkdocs](https://www.mkdocs.org/) and uses [material theme](https://squidfunk.github.io/mkdocs-material/)

- Find it at [docs/index.md](docs/index.md)
- Or Run the doc server locally :

```
docker run --rm -it -p 8000:8000 -v ${PWD}:/docs squidfunk/mkdocs-material
```

