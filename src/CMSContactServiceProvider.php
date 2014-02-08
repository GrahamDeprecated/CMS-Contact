<?php

/**
 * This file is part of CMS Contact by Graham Campbell.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 */

namespace GrahamCampbell\CMSContact;

use Illuminate\Support\ServiceProvider;

/**
 * This is the cms contact service provider class.
 *
 * @package    CMS-Contact
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Contact/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Contact
 */
class CMSContactServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('graham-campbell/cms-contact', 'graham-campbell/cms-contact', __DIR__);

        include __DIR__.'/routes.php';
        include __DIR__.'/filters.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerContactController();
    }

    /**
     * Register the contact controller class.
     *
     * @return void
     */
    protected function registerContactController()
    {
        $this->app->bind('GrahamCampbell\CMSContact\Controllers\ContactController', function ($app) {
            $credentials = $app['credentials'];

            return new Controllers\ContactController($credentials);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }
}
