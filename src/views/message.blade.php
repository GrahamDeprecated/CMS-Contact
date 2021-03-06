@extends(Config::get('views.email', 'layouts.email'))

@section('content')
<p>{{ $name }} has sent you a message through the contact form on <a href="{{ $url }}">{{ Config::get('platform.name') }}</a>.<p>
<p>Their message was:<p>
<blockquote>{{ $quote }}</blockquote>
<p>You may contact them via their email address: <a href="mailto:{{ $contact }}">{{ $contact }}</a>.<p>
@stop
