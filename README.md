# W-Vision Pimcore Deployer

This library gives you a clean example of how to use deployer with Pimcore 5.*.

It provides you with additional tasks needed to successfully deploy Pimcore application into different environments.

## Installation

```
composer require w-vision/pimcore-deployer
```

Installation installs deployer as well.

Now copy following files into your root-folder:

```
vendor/w-vision/pimcore-deployer/deploy.sample.php -> deploy.php
```

Edit .deploy.php to suit your configuration.

## Usage

There is a sample deployer configuration file, which shows you how to configure deployer for Pimcore.

### Start Deployment

```
vendor/bin/dep deploy
```