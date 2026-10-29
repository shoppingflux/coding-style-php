# shoppingfeed/coding-style-php

### Installation

```
composer require shoppingfeed/coding-style-php
```

### Contributing

To connect to a php 8.0 container correctly configured

- Create a container : `docker run --name coding-style-php -v $PWD:/var/www -w /var/www -d php:8.0-fpm`
- Install composer in the container (first time only) :

```
docker exec coding-style-php bash -c "curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer"
```

- Update composer dependencies (from the host) :

```
docker run --rm -u $(id -u):$(id -g) -v $PWD:/app composer:2 sh -c "composer config --global platform.php 8.0.30 \
  && composer config --global allow-plugins.dealerdirect/phpcodesniffer-composer-installer true && composer update"
```

- Connect to container : `docker exec -it coding-style-php bash`

Once connected to the container you can :

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

