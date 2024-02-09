@extends('layout')

@section('title', 'Login')
<link rel="stylesheet" href="{{ asset('style.css') }}">

@section('loginPage')



<div class="container mt-5 d-flex align-items-center justify-content-center">
  <div class="loginContainer bg-white rounded shadow p-4 w-md-50">
    <div class="text-center mb-4">
      <img src="{{ asset('thelogo.png') }}" alt="MacArthur Central School Logo" class="img-fluid" width="150">
    </div>

    <h1 class="h1logintext">MacArthur Central School</h1>
    <h2 class="h2logintext">Inventory Management System</h2>

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

    <form action="{{ route('login.post') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">Employee Email</label>
        <input type="email" class="form-control" name="email" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" class="form-control" name="password" required>
      </div>
      <div class="text-center">
        <button type="submit" class="btn btn-success">Login</button>
      </div>
    </form>


  </div>
</div>

<div class="container mx-auto text-center">
    <p>Contact a system administrator to create an account or if you are having trouble logging in.</p>
  </div>


@endsection


