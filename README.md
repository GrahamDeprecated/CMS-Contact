CMS Contact
===========


[![Bitdeli Badge](https://d2weczhvl823v0.cloudfront.net/GrahamCampbell/CMS-Contact/trend.png)](https://bitdeli.com/free "Bitdeli Badge")
[![Build Status](https://travis-ci.org/GrahamCampbell/CMS-Contact.png?branch=master)](https://travis-ci.org/GrahamCampbell/CMS-Contact)
[![Latest Version](https://poser.pugx.org/graham-campbell/cms-contact/v/stable.png)](https://packagist.org/packages/graham-campbell/cms-contact)
[![Total Downloads](https://poser.pugx.org/graham-campbell/cms-contact/downloads.png)](https://packagist.org/packages/graham-campbell/cms-contact)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/GrahamCampbell/CMS-Contact/badges/quality-score.png?s=dc4c5381f6889d8e70061d20d77fe81b571676bd)](https://scrutinizer-ci.com/g/GrahamCampbell/CMS-Contact)
[![Still Maintained](http://stillmaintained.com/GrahamCampbell/CMS-Contact.png)](http://stillmaintained.com/GrahamCampbell/CMS-Contact)


## THIS ALPHA RELEASE IS FOR TESTING ONLY


## What Is CMS Contact?

CMS Contact is a [Bootstrap CMS](https://github.com/GrahamCampbell/Boostrap-CMS) plugin that adds a contact form backend.  

* CMS Contact was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).  
* CMS Contact relies on my [CMS Core](https://github.com/GrahamCampbell/CMS-Core) package.  
* CMS Contact uses [Travis CI](https://travis-ci.org/GrahamCampbell/CMS-Contact) to run tests to check if it's working as it should.  
* CMS Contact uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/CMS-Contact) to run additional tests and checks.  
* CMS Contact uses [Composer](https://getcomposer.org) to load and manage dependencies.  
* CMS Contact provides a [change log](https://github.com/GrahamCampbell/CMS-Contact/blob/master/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/CMS-Contact/releases), and a [wiki](https://github.com/GrahamCampbell/CMS-Contact/wiki).  
* CMS Contact is licensed under the Apache License, available [here](https://github.com/GrahamCampbell/CMS-Contact/blob/master/LICENSE.md).  


## System Requirements

* PHP 5.4+ or PHP 5.5+ is required.
* You will need [Laravel 4](http://laravel.com) because this package is designed for it.  
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of CMS-Contact.  


## Installation

Please check the system requirements before installing CMS Contact.  

To get the latest version of CMS Contact, simply require it in your `composer.json` file.

`"graham-campbell/cms-contact": "dev-master"`

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once CMS Contact is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

`'GrahamCampbell\CMSContact\CMSContactServiceProvider'`

You will need to write your own contact form with this plugin. CMS Comment simply provides you with the backend functionality to create a comment form. CMS Comment form will register the route `contact.post` which will accept `POST` requests to the path `contact`.


## Updating Your Fork

The latest and greatest source can be found on [GitHub](https://github.com/GrahamCampbell/CMS-Contact).  
Before submitting a pull request, you should ensure that your fork is up to date.  

You may fork CMS Contact:  

    git remote add upstream git://github.com/GrahamCampbell/CMS-Contact.git

The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as [P4Merge](http://perforce.com/product/components/perforce_visual_merge_and_diff_tools).  

You can then update the branch:  

    git pull --rebase upstream develop
    git push --force origin <branch_name>

Once it is set up, run `git mergetool`. Once all conflicts are fixed, run `git rebase --continue`, and `git push --force origin <branch_name>`.  


## Pull Requests

Please submit pull requests against the develop branch.  

* Any pull requests made against the master branch will be closed immediately.  
* If you plan to fix a bug, please create a branch called `fix-`, followed by an appropriate name.  
* If you plan to add a feature, please create a branch called `feature-`, followed by an appropriate name.  
* Please indent with 4 spaces rather than tabs, and make sure your code is commented.  


## License

GNU AFFERO GENERAL PUBLIC LICENSE  

CMS Contact Is A Bootstrap CMS Plugin That Adds A Contact Form Backend  
Copyright (C) 2013  Graham Campbell  

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU Affero General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.  

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU Affero General Public License for more details.  

You should have received a copy of the GNU Affero General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.  