## Most Sacred Things: A Museum of Relationships

A Laravel/Vue front end for the correspondence of William Hayley.

![amor](https://user-images.githubusercontent.com/286552/163792624-f6ae078e-9a99-4bf6-9406-705cf9f1d03b.jpg)


This project interfaces with three apis that come from:

* Omeka Classic located at https://hayleypapers.fitzmuseum.cam.ac.uk/ (uses a basic theme)
* Hypothes.is (overlays can be found via https://via.hypothes.is/http://hayleypapers.fitzmuseum.cam.ac.uk/)
* Mediawiki

No API keys are needed to run this project, all data is openly licensed, images
are more restricted due to University of Cambridge standpoint. The search engine will not
work unless you have access to the Fitzwilliam solr cores (IP restricted.)

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

```bash
git clone https://github.com/FitzwilliamMuseum/amor-fitz-frontend
cd amor-fitz-frontend
composer install
cp .env.example .env
php artisan key:generate
npm install
```
You now need to decide whether you will run in:

#### Development (you can inspect the vue output)

```bash
npm run dev
```

#### Production

```bash
npm run production
```

### Running the project

This should get the bare bones up and running. Which will enable you to test the install:

```bash
php artisan serve
```

Or if you are running a vhost, you will need to point to the public folder.

### Solr search

You will want to connect to our solr instance if you want to get the search module returning results.

The config for solr connection is found in:

```
config/solarium.php
```

And interfaces directly with the omeka core. If you want access, we can enable your IP address through our firewall.

### Caching

The calls to the omeka api are manifold, and so first load of pages can be very slow. We cache everything - api calls and page output. Caching can be set up to use any of the laravel adapters, at the moment caching is done at file level.

To clear the caches:

```bash
php artisan cache:clear  
```

### Front end UX/UI

This project was funded by the British Academy/Leverhulme Trust and Cambridge Humanities Research Grants, from which funding allowed us to work with Alexa Steinbrück and Philo van Kemenade to develop a tachyons based vue front end design.

This can be found as a repo at:

https://github.com/phivk/fitz-hayley

As a story book at:

https://phivk.com/fitz-hayley/?path=/story/example-introduction--page

### License

GPLV3

### Funders

  <a href="https://www.thebritishacademy.ac.uk/" title="The British Academy">
    <img src="public/images/svg/ba-logo.svg" alt="British Academy Logo" width="200">
  </a>

  <a href="https://cam.ac.uk" title="The Leverhulme Trust">
    <img src="public/images/svg/cambridge-logo.svg" alt="Cambridge University Logo" width="200">
  </a>

  <a href="https://www.leverhulme.ac.uk" title="The Leverhulme Trust">
    <img src="public/images/svg/leverhulme-logo.svg" alt="Leverhulme Trust Logo" width="200">
  </a>

### Future development

This project was a pilot, and only includes a very selected amount of Hayley's correspondence. If
and when more funding is found, this project may develop further. 
