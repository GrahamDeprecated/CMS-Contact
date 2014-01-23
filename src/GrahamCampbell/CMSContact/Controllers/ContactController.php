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

namespace GrahamCampbell\CMSContact\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\HTMLMin\Facades\HTMLMin;
use GrahamCampbell\Queuing\Facades\Queuing;
use GrahamCampbell\CMSCore\Facades\UserProvider;
use GrahamCampbell\CMSCore\Controllers\AbstractController;

/**
 * This is the contact controller class.
 *
 * @package    CMS-Contact
 * @author     Graham Campbell
 * @copyright  Copyright (C) 2013-2014  Graham Campbell
 * @license    https://github.com/GrahamCampbell/CMS-Contact/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/CMS-Contact
 */
class ContactController extends AbstractController
{
    /**
     * Constructor (setup access permissions).
     *
     * @return void
     */
    public function __construct()
    {
        $this->beforeFilter('throttle.contact', array('only' => array('postSubmit')));

        parent::__construct();
    }

    /**
     * Submit the contact form.
     *
     * @return \Illuminate\Http\Response
     */
    public function postSubmit()
    {
        $input = array(
            'first_name' => Binput::get('first_name'),
            'last_name'  => Binput::get('last_name'),
            'email'      => Binput::get('email'),
            'message'    => Binput::get('message')
        );

        $rules = array(
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required',
            'message'    => 'required'
        );

        $val = Validator::make($input, $rules);
        if ($val->fails()) {
            return Redirect::to(Config::get('cms-contact::path'))->withInput()->withErrors($val);
        }

        $email = Config::get('cms-contact::email');

        if ($email === null) {
            $user = UserProvider::find(1);
            if (!$user) {
                Session::flash('error', 'We were unable to send the message. Please contact support.');
                return Redirect::to(Config::get('cms-contact::path'))->withInput();
            }

            $email = $user->email;
        }

        $url = URL::route('pages.show', array('pages' => 'home'));

        $quote = HTMLMin::render(nl2br(e($input['message'])));

        try {
            $data = array(
                'view'    => 'cms-contact::message',
                'email'   => $email,
                'subject' => Config::get('platform.name').' - New Message',
                'url'     => $url,
                'contact' => $input['email'],
                'name'    => $input['first_name'].' '.$input['last_name'],
                'quote'   => $quote
            );

            Queuing::pushMail($data);

            $data = array(
                'view'    => 'cms-contact::thanks',
                'email'   => $input['email'],
                'subject' => Config::get('platform.name').' - Notification',
                'url'     => $url,
                'name'    => $input['first_name'],
                'quote'   => $quote
            );

            Queuing::pushMail($data);
        } catch (\Exception $e) {
            Log::alert($e);
            Session::flash('error', 'We were unable to send the message. Please contact support.');
            return Redirect::to(Config::get('cms-contact::path'))->withInput();
        }

        Session::flash('success', 'Your message was sent successfully. Thank you for contacting us.');
        return Redirect::route('pages.show', array('pages' => 'home'));
    }
}
