@extends('include.dash_side')

@section('nav-back')
    <a class="nav-link" href="{{ route('manageEmployees') }}" 
    onclick="return confirm('Are you sure you want to return to the previous page? All the changes that you have made WILL NOT BE SAVED')">
        < Back
    </a>
@endsection

@section('content')

<div class="container mt-4">
    <h2 class="text-center">Edit Employee</h2>
    <p class = "text-center">Editing details for ID: {{$user->id}} - {{ $user->name }}
        @if($user->usertype === 'admin')
        (Admin) <br> An <b>OTP</b> may be required to update the details of the account.
        @elseif($user->usertype === 'user')
        (Regular User)
        @endif
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

    <form action="{{ url('update-data/'.$user->id) }}" method="POST" class="mx-auto">
        @csrf
        @method('PUT')
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" class="form-control" id="id" name="id" value="{{ $user->id }}" readonly>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                </div>
            </div>
        </div>
        <div class="row justify-content-center"> <!-- Make sure the email field is inside the same structure -->
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="email" class="form-label">Employee Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mx-auto text-end">
                <a class="btn btn-danger"  href="{{ route('manageEmployees') }}" 
                onclick="return confirm('Changes will not be saved if you CANCEL')">
                    Cancel
                </a>
                <button type= "submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
</div>
@endsection
