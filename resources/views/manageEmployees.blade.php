@extends('include.dash_side')
@section('title', 'Manage Employees') <!-- This is the title of the page -->

@section('nav-back')
<h5> 
        @auth
        Account: {{auth()->user()->name}} (ID: {{auth()->user()->id}})
        @endauth
</h5>
@endsection


@section('content')

<p>
    This is the Manage Employees page, Authorized Access Only!
</p>

@if($errors->any())
<div class="alert alert-danger">
    @foreach($errors->all() as $error)
    <div>{{$error}}</div>
    @endforeach
</div>
@endif

@if(session()->has('error'))
<div class="alert alert-danger">{{session()->get('error')}}</div>
@endif

@if(session()->has('success'))
<div class="alert alert-success">{{session()->get('success')}}</div>
@endif
<div class = "text-end">

    <a href="{{ route('registration') }}" class="btn btn-success mx-2">+ Add Employee</a>
<div class="table-responsive">
    <table class="etable text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>User Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr id="user_{{ $user->id }}">
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone}}</td>
                <td>{{ $user->usertype }}</td>

                <td>
                    @if(auth()->user()->id === $user->id)
                        <a href="{{ url('edit/'.$user->id) }}" class="btn btn-primary">Edit</a>
                    @elseif(auth()->user()->usertype === 'admin' && $user->usertype !== 'admin')
                        <a href="{{ url('edit/'.$user->id) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('delete/'.$user->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to remove user {{$user->name}} with ID {{$user->id}}?')">Remove</a>
                    @endif
                </td>
            </tr>
            @endforeach

            

            
        </tbody>
    </table>

    {{$users->links()}}




</div>



@endsection