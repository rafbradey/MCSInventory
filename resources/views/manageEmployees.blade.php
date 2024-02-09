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

                <td class="text-center">
                    <div class="d-flex justify-content-center">
                        @if(auth()->user()->usertype === 'admin')
                            @if($user->usertype !== 'admin')
                                <form id="promoteForm{{$user->id}}" action="{{ url('promote/'.$user->id) }}" method="POST" class="mx-1">
                                    @csrf
                                    <button type="button" onclick="confirmPromotion({{$user->id}})" class="btn btn-warning"><i class="fa-solid fa-user-shield"></i>Promote</button>
                                </form>
                                <script>
                                    function confirmPromotion(userId) {
                                        var confirmation = prompt("Please type 'confirm' to promote this user to admin:");
                                        if (confirmation !== null && confirmation.toLowerCase() === 'confirm') {
                                            // If the user confirms, submit the form
                                            document.getElementById('promoteForm' + userId).submit();
                                        } else {
                                            // If the user cancels or inputs something else, do nothing
                                            alert("Promotion canceled.");
                                        }
                                    }
                                </script>
                            @endif
                        @endif
                        
                        @if(auth()->user()->id === $user->id)
                            <a href="{{ url('edit/'.$user->id) }}" class="btn btn-primary mx-1"><i class="fa-solid fa-pen-to-square"></i></a>
                        @endif
                        
                        @if(auth()->user()->usertype === 'admin' && $user->usertype !== 'admin')
                            <a href="{{ url('edit/'.$user->id) }}" class="btn btn-primary mx-1"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{ url('delete/'.$user->id) }}" class="btn btn-danger mx-1" onclick="return confirm('Are you sure you want to remove user {{$user->name}} with ID {{$user->id}}?')"><i class="fa-solid fa-trash"></i></a>
                        @endif
                    </div>
                </td>
                
                
                
                
            </tr>
            @endforeach

            

            
        </tbody>
    </table>

    {{$users->links()}}




</div>



@endsection