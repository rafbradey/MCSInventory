<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;  // This is the namespace of the controller.
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Models\User;
use App\Models\UserRequests;
use App\Models\Inventory;
use App\Models\Report;
use App\Mail\HelloEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail($id)
    {
        /** 
         * Store a receiver email address to a variable.
         * 
         */

        $user = User::find($id);
        $receiverEMAIL = $user->email;
        /**
         * Import the Mail class at the top of this page,
         * and call the to() method for passing the 
         * receiver email address.
         * 
         * Also, call the send() method to incloude the
         * HelloEmail class that contains the email template.
         */
        Mail::to($receiverEMAIL)->send(new HelloEmail);

        /**
         * Check if the email has been sent successfully, or not.
         * Return the appropriate message.
         */
        Mail::flushMacros();
        return view('requests', compact('user'))->with('message', 'Request has been cancelled. A notification has been sent to the user.');
    }
}