@extends('layout')
@section('title', 'Login') <!-- This is the title of the page -->
<link rel = "stylesheet" href = "{{asset('style.css')}}">
@section('loginPage')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
           
            <div class="loginContainer bg-white rounded shadow p-4">
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

                <form action="{{route('login.post')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Employee Email</label>
                        <input type="email" class="form-control" name="email">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection