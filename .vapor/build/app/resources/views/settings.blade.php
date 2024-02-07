@extends('include.dash_side')
@section('nav-back')
<h5> 
        @auth
        Account: {{auth()->user()->name}} (ID: {{auth()->user()->id}})
        @endauth
</h5>
@endsection
@section('title', 'Settings')

@section('content')

@if(auth()->user()->usertype === 'admin')
    
<p>
    Admin Settings
</p>
@else

<p>
    User Settings
</p>
@endif

@endsection