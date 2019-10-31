# shoppingfeed/coding-style-php

### Installation

```
composer require shoppingfeed/coding-style-php
```

### Documentation

Documentation is driven by [mkdocs](https://www.mkdocs.org/) and uses [material theme](https://squidfunk.github.io/mkdocs-material/)

- Find it at [docs/index.md](docs/index.md)
- Or Run the doc server locally :

```
docker run --rm -it -p 8000:8000 -v ${PWD}:/docs squidfunk/mkdocs-material
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
