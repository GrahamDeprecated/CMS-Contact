@extends('layouts.email')

@section('content')
<p>Thank you {{ $name }} for contacting <a href="{{ $url }}">{{ Config::get('cms.name') }}</a>.</p>
<p>Your message will be reviewed, and you may be contacted again via this email address if required.</p>
<p>For reference, your message was:<p>
<blockquote>{{ $quote }}</blockquote>
@stop
