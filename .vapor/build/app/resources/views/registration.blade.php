@extends('include.dash_side')

@section('title', 'Add Employee')

@section('nav-back')
    <a class="nav-link" href="{{ route('manageEmployees') }}" 
    onclick="return confirm('Are you sure you want to return to the previous page? All the changes that you have made WILL NOT BE SAVED')">
        &lt; Back
    </a>
@endsection

@section('content')
    <div class="container">
        <div class="mt-5">
            @if($errors->any())
                <div class="col-12">
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div> 
                    @endforeach
                </div>
            @endif

            @if(session()->has('error'))
                <div class="alert alert-danger">{{ session()->get('error') }}</div>
            @endif

            @if(session()->has('success'))
                <div class="alert alert-success">{{ session()->get('success') }}</div>
            @endif
        </div>

        <form action="{{ route('registration.post') }}" method="POST" class="mx-auto" style="width: 500px;">
            @csrf <!-- This is used to prevent cross-site request forgery -->
          
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="name" class="form-control" name="name">
            </div>

            <div class="mb-3">
                <label class="form-label">Employee Email address</label>
                <input type="email" class="form-control" name="email">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number (Should be 11 digits, e.g. 09921234567)</label>
                <input type="tel" class="form-control" id="phone" name="phone">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password">
            </div>

            <button type="submit" class="btn btn-success d-block mx-auto">+ Add Employee</button>
        </form>
    </div>
@endsection