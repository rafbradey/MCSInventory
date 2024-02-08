@extends('include.dash_side')

@section('nav-back')
  <h5>@auth Account: {{ auth()->user()->name }} (ID: {{ auth()->user()->id }}) @endauth</h5>
@endsection

@section('title', 'Settings')

@section('content')
  <div class="container-fluid h-100 d-flex justify-content-center align-items-center">
    <div class="container settings-container bg-light p-4 shadow rounded-lg w-50 text-center">
      @if (auth()->user()->usertype === 'admin')
        <i class="fa-solid fa-sliders"></i><h2 class="mb-4">Admin Settings</h2>
        <div class="row d-flex flex-wrap justify-content-center align-items-stretch">
          <a href="password" class="btn btn-primary btn-lg m-2">Change Phone Number</a>
          <p class="text-muted w-100">Update your registered phone number for account security and verification.</p>
          <a class="btn btn-primary btn-lg m-2">Reset Password</a>
          <p class="text-muted w-100">Secure your account by changing your password regularly.</p>
          @if (auth()->user()->email_verified_at)
          <p class="text-success">Your email address is verified!</p>
        @else
          <a href = "email/verify" type="a" class="btn btn-primary btn-lg mt-4">Verify Email Address</a>
          <p class="text-muted">Click the a to verify your email address.</p>
        @endif
        </div>
        
      @else
        <i class="fa-solid fa-sliders"></i> <h2 class="mb-4">User Settings</h2>
        <div class="row d-flex flex-wrap justify-content-center align-items-stretch">
          <a href="password" class="btn btn-primary btn-lg m-2">Change Phone Number</a>
          <p class="text-muted w-100">Update your registered phone number.</p>
          <a href="password/reset" class="btn btn-primary btn-lg m-2">Reset Password</a>
          <p class="text-muted w-100">Secure your account by changing your password regularly.</p>
          <a class="btn btn-primary btn-lg m-2">Request Email Change</a>
          <p class="text-muted w-100">Start the process of updating your registered email address. An admin will approve the request.</p>
          @if (auth()->user()->email_verified_at)
          <p class="text-success">Your email address is verified!</p>
        @else
          <a href = "email/verify" type="a" class="btn btn-primary btn-lg mt-4">Verify Email Address</a>
          <p class="text-muted">Click the a to verify your email address.</p>
        @endif

        </div>
      @endif
    </div>
  </div>

  <style>
    .settings-container {
      background-color: #f5f5f5;
      border-radius: 8px;
      border: #009879 !important;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      color: #333; 
    }

    .btn-primary {
      background-color: #009879; 
      border-radius: 8px;
      border: #009879 !important;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }


 
  </style>
@endsection