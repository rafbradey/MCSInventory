<?php

namespace App\Http\Controllers;

use App\Mail\HelloEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        // Hardcoded receiver email address for testing
        $receiverEmail = "rafbradey5@gmail.com";
        
        // Send the email using the HelloEmail Mailable
        Mail::to($receiverEmail)->send(new HelloEmail());
        
        // Return a view with a message indicating the status of the email sending process
        return view('settings')->with('message', 'Request has been cancelled. A notification has been sent to the user.');
    }
}