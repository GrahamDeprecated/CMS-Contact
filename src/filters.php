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

Route::filter('throttle.contact', function ($route, $request) {
    if (!Throttle::hit($request, 2, 30)->check()) {
        Session::flash('error', 'You have made too many submissions recently. Please try again later.');
        return Redirect::route(Config::get('graham-campbell/cms-contact::path'))->withInput();
    }
});
