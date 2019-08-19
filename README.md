![Pimcore Deployer](docs/images/github_banner.png "Pimcore Deployer")

This library gives you a clean example of how to use [Deployer](https://deployer.org/) together with
[Pimcore](https://pimcore.com/en) (Version 5+) in order to deploy your application to a web server.

It provides you with additional tasks needed to successfully deploy a Pimcore application into different environments.

## Installation

```
composer require w-vision/pimcore-deployer
```

Installation installs the [Deployer library](https://github.com/deployphp/deployer) as well.

## Usage

There is a sample Deployer configuration file, which shows you how to configure Deployer for Pimcore.
Copy the file into your root-folder:

```
vendor/w-vision/pimcore-deployer/deploy.sample.php -> deploy.php
```

Edit the file `deploy.php` to suit your configuration.

### Start Deployment

```
vendor/bin/dep deploy
```
