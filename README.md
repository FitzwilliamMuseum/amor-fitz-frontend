## Most Sacred Things: A Museum of Relationships

A Laravel/Vue front end for the correspondence of William Hayley.

This project interfaces with three apis that come from:

* Omeka Classic
* Hypothes.is
* Mediawiki

No API keys are needed to run this project, all data is openly licensed, images
are more restricted due to University of Cambridge standpoint. The search engine will not
work unless you have access to the Fitzwilliam solr cores (IP restricted, or you set up your own
solr instance - see below.)

### Dependences

This works with:

* git
* curl
* composer
* minimum php 7.3
* Laravel 8
* Node
* Vue
* npm

### Installation

We assume you have Git, Curl, Composer, PHP, node and npm installed on your machine of choice.
Therefore to install this system follow these steps:

``bash
git clone https://github.com/FitzwilliamMuseum/amor-fitz-frontend
cd amor-fitz-frontend
composer install
cp .env.example .env
php artisan generate key
npm install
npm run dev
```

This should get the bare bones up and running. You will want to connect to our solr instance
if you want to get the search module returning results.

The config for solr connection is found in:

```
config/solarium.php
```

And interfaces directly with the omeka core. If you want access, we can enable your IP address through our firewall.


### Front end UX/UI

This project was funded by the British Academy/Leverhulme Trust and Cambridge Humanities Research Grants, from which funding allowed us to work with Alexa Steinbrück and Philo van Kemenade to develop a tachyons based vue front end design.

This can be found as a repo at:

https://github.com/phivk/fitz-hayley

As a story book at:

https://phivk.com/fitz-hayley/?path=/story/example-introduction--page



### License

GPLV3
