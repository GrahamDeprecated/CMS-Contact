<?php namespace GrahamCampbell\CMSContact\Controllers;

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
 *
 * @package    CMS-Contact
 * @author     Graham Campbell
 * @license    GNU AFFERO GENERAL PUBLIC LICENSE
 * @copyright  Copyright (C) 2013  Graham Campbell
 * @link       https://github.com/GrahamCampbell/CMS-Contact
 */

use Config;
use Queuing;
use Log;
use Redirect;
use Session;
use URL;
use Validator;

use GrahamCampbell\Binput\Facades\Binput;
use GrahamCampbell\HTMLMin\Facades\HTMLMin;
use GrahamCampbell\CMSCore\Facades\UserProvider;
use GrahamCampbell\CMSCore\Controllers\BaseController;

class ContactController extends BaseController
{
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

            $email = $user->getEmail();
        }

        $url = URL::route('pages.show', array('pages' => 'home'));

        $quote = HTMLMin::render(nl2br(e($input['message'])));

        try {
            $data = array(
                'view'    => 'cms-contact::message',
                'email'   => $email,
                'subject' => Config::get('cms.name').' - New Message',
                'url'     => $url,
                'contact' => $input['email'],
                'name'    => $input['first_name'].' '.$input['last_name'],
                'quote'   => $quote
            );

            Queuing::pushMail($data);

            $data = array(
                'view'    => 'cms-contact::thanks',
                'email'   => $input['email'],
                'subject' => Config::get('cms.name').' - Notification',
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
