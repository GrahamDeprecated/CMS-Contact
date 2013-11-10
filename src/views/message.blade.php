@extends('layouts.email')

@section('content')
<p>{{ $name }} has sent you a message through the contact form on <a href="{{ $url }}">{{ Config::get('cms.name') }}</a>.<p>
<p>Their message was:<p>
<blockquote>{{ $quote }}</blockquote>
<p>You may contact them again via their email address: {{ $contact }}<p>
@stop
