<?php

namespace App\Http\Controllers;
use App\Imports\UsersImport;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\Inventory;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\UserRequests;
use App\Models\request_history;
use App\Models\Report;



class AuthManager extends Controller
{


    //Create function for login and registration
    function login(){
        if (Auth::check()) {
            if (Auth::user()->usertype == 'admin') {
            return redirect(route('dashboard'));
            }
           else if (Auth::user()->usertype == 'user') return redirect(route('dashboard'));
        }
        return view('login');
    }

    function registration(){
      if (Auth::check()) {
            return view ('registration');
      }
        return view('registration');
    }








function manageEmployees() {
    if (Auth::check()) {
        if (Auth::user()->usertype == 'admin') {
            $users = User::whereIn('usertype', ['user', 'admin'])->paginate(10);; //gets both the usertype's data (admin and user)
            return view('manageEmployees', compact('users'));
        } else {
            return redirect()->route('dashboard');
        }
    }
    
    return redirect()->route('login'); // Redirect unauthenticated users to the login page
}


function settings(){
    if (Auth::check()) {
        return view('settings');
    }
    return redirect()->route('login'); // Redirect unauthenticated users to the login page
}


    function loginPost(Request $request){
 
        $request->validate([ //check if email and password are present, if not error
            'email' => 'required',
            'password' => 'required'

        ]);

        $credentials = $request->only('email','password'); //get email and password from request
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('dashboard'))->with("Success!"); //if credentials are correct, redirect to home page (defined in route)

         }
         return redirect(route('login'))->with("error", "Login details are not valid");
    }

    function registrationPost(Request $request){
        $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'phone' => 'required|unique:users|digits:11', // Adding the phone number validation rule
        'password' => 'required|min:6',
        //adding  variables here means to assign it as fillable in Models > User.php
        //if not, it will throw an error/will not be saved in the database - raf
        ]);


        $data['name'] = $request->name; //get name from request
        $data['email'] = $request->email; //get email from request
        $data['phone'] = $request->phone; //get phone from request
        $data['password'] = Hash::make($request->password); //get password from request
        $user = User::create($data);

        if(!$user){

            return redirect(route('registration'))->with("error", "Registration details are not valid");

        }

        return redirect('/manageEmployees')->with('success', 'The user with ID: '.$user->id.' - '.$user->name.' was ADDED successfully!');

    }

    public function logout(){

        Session::flush(); //clears all session data
        Auth::logout(); //logs out the user

        auth()->logout();
        return redirect()->route('login')->with('Success', 'You have been logged out');
    }

 


    public function edit($id)
    {
        if (Auth::user()->usertype == 'admin'){
            $user = User::find($id);
            return view('include.edit', compact('user'));
        }
        return redirect()->route('dashboard')->with('error', 'You do not have permission to edit a user');
    }



public function update(Request $request, $id){ //prevents deletion of accounts via url
    if (Auth::user()->usertype == 'admin'){
        $request->validate([ //check if email and password are present, if not error
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|digits:11',

        ]);
        $user = User::find($id);
        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->update();

        return redirect('/manageEmployees')->with('success', 'Details for '.$user->usertype.' with ID: '.$user->id.' - '.$user->name.' was UPDATED successfully!');

    }

    return redirect()->route('dashboard')->with('error', 'You do not have permission to edit a user');

}

    
    public function remove($id)
    {
        if (Auth::user()->usertype == 'admin'){
            $user = User::find($id);
            $user->delete();
            return redirect('/manageEmployees')->with('success', 'The '.$user->usertype.' with ID: '.$user->id.' - '.$user->name.' was REMOVED successfully!');
        }
        return redirect()->route('manageEmployees')->with('error', 'You do not have permission to delete a user');
        
    }

public function importUsers(){
    return view('importUsers');
    return redirect('/manageEmployees')->with('success', 'The user with ID: '.$user->id.' - '.$user->name.' was ADDED successfully!');
}


/*
public function import() 
{
    Excel::import(new Inventory, 'inventory.xlsx');
    return redirect('inventory')->with('success', 'All good!');
}
*/

public function inventory()
{
    if (Auth::check()) {
 
   $Inventory = Inventory::paginate(10); // Retrieve inventory data from the database and paginate it
    return view('Inventory', compact('Inventory'));
}

    return redirect()->route('login'); // Redirect unauthenticated users to the login page
}


public function editInventory($id)
{
    if (Auth::user()->usertype == 'admin'){
        $Inventory = Inventory::find($id);
        return view('include.edit_item', compact('Inventory'));
    }
    return redirect()->route('dashboard')->with('error', 'You do not have permission to edit a Inventory');
}

public function updateInventory(Request $request, $id)
{
    // Check if the user is admin
    if (Auth::user()->usertype == 'admin') {
        // Validate the incoming request
        $request->validate([
            'school_property' => 'required',
            'property_number' => 'nullable',
            'unit_of_measure' => 'nullable',
            'unit_value' => 'nullable|numeric',
            'quantity_per_property' => 'nullable|integer',
            'quantity_per_physical' => 'nullable|integer',
            'quantity' => 'nullable|integer',
            'value' => 'nullable|numeric',
            'total_value' => 'nullable|numeric',
            'remarks' => 'nullable',
            'category' => 'nullable',
            'acquisition_type' => 'nullable',
            'grade_level' => 'nullable',
        ]);

        // Find the inventory item by its ID
        $Inventory = Inventory::find($id);

        // Update the inventory details
        $Inventory->school_property = $request->input('school_property');
        $Inventory->property_number = $request->input('property_number');
        $Inventory->unit_of_measure = $request->input('unit_of_measure');
        $Inventory->unit_value = $request->input('unit_value');
        $Inventory->quantity_per_property = $request->input('quantity_per_property');
        $Inventory->quantity_per_physical = $request->input('quantity_per_physical');
        $Inventory->quantity = $request->input('quantity');
        $Inventory->value = $request->input('value');
        $Inventory->total_value = $request->input('total_value');
        $Inventory->remarks = $request->input('remarks');
        $Inventory->category = $request->input('category');
        $Inventory->acquisition_type = $request->input('acquisition_type');
        $Inventory->grade_level = $request->input('grade_level');

        // Save the changes
        $Inventory->save();

        // Redirect with success message
        return redirect('/inventory')->with('success', 'The item with ID: '.$Inventory->id.' - '.$Inventory->school_property.' was UPDATED successfully!');
    } else {
        // If user is not admin, redirect with an error message
        return redirect('/dashboard')->with('error', 'You do not have permission to update inventory items.');
    }
}



public function removeConfirm($id)
{
    if (Auth::user()->usertype == 'admin'){
        $Inventory = Inventory::find($id);
        return view('include.edit_delete_confirm', compact('Inventory'));
    }
    return redirect()->route('dashboard')->with('error', 'You do not have permission to edit a Inventory');
}

public function removeItem($id)
{
    if (Auth::user()->usertype == 'admin'){
        $Inventory = Inventory::find($id);
        $Inventory->delete();
        return redirect('/inventory')->with('success', 'The item with ID: '.$Inventory->id.' - '.$Inventory->school_property.' was REMOVED successfully!');
    }
    return redirect()->route('dashboard')->with('error', 'You do not have permission to delete an item');
    
}



function requests(){
    if (Auth::check()) {
        return view('requests');
    
    }
    return redirect()->route('login'); // Redirect unauthenticated users to the login page
}
  

public function search_inventory(Request $request)
{
    $Inventory = Inventory::query(); // Initialize the query builder

    if ($request->has('query')) {
        $search_text = $request->input('query');
        $Inventory->where(function($query) use ($search_text) {
            $query->where('id', 'LIKE', '%' . $search_text . '%')
                  ->orWhere('school_property', 'LIKE', '%' . $search_text . '%')
                  ->orWhere('remarks', 'LIKE', '%' . $search_text . '%')
                  ->orWhere('category', 'LIKE', '%' . $search_text . '%')
                  ->orWhere('acquisition_type', 'LIKE', '%' . $search_text . '%')
                  ->orWhere('grade_level', 'LIKE', '%' . $search_text . '%');
        });
    }

    $Inventory = $Inventory->paginate(10);

    return view('inventory', compact('Inventory'));
}





public function requestDetails($id)
{
    if (Auth::check()) {
       $Inventory = Inventory::find($id);
        $UserRequest = UserRequests::where('inventory_id', $id)->first();

        return view('include.requestDetails', [
            'Inventory' => $Inventory,
            'UserRequest' => $UserRequest
        ]);
    }

    return redirect()->route('login'); 
}



public function requestPage()
{
    if (Auth::check()) {
        $UserRequests = UserRequests::all();
        $AcceptedRequests = UserRequests::where('status', 'accepted')->get();
        $request_history = request_history::all();

        return view('requests', compact('UserRequests', 'AcceptedRequests', 'request_history'));
    }
    return redirect()->route('login'); // Redirect unauthenticated users to the login page
}




public function addRequest(Request $request) {
    // Validate the incoming request
    $request->validate([
        'user_id' => 'required',
        'inventory_id' => 'required',
        'status' => 'nullable',
        'school_property' => 'required',
        'property_number' => 'nullable',
        'unit_of_measure' => 'nullable',
        'unit_value' => 'nullable|numeric',
        'quantity_per_property' => 'nullable|integer',
        'quantity_per_physical' => 'nullable|integer',
        'quantity' => 'nullable|integer|min:1',
        'value' => 'nullable|numeric',
        'total_value' => 'nullable|numeric',
        'remarks' => 'nullable',
        'category' => 'nullable',
        'acquisition_type' => 'nullable',
        'grade_level' => 'nullable',


    ]);
    // Set the status to pending
    $status = $request->input('status', 'pending');
    // Find the inventory record by its ID
    $inventory = Inventory::find($request->inventory_id);
    $userRequest = UserRequests::where('inventory_id', $request->inventory_id)->first();

    $schoolProperty = $request->input('school_property');
    $property_number = $request->input('property_number');
    $unit_of_measure = $request->input('unit_of_measure');
    $unit_value = $request->input('unit_value');
    $quantity_per_property = $request->input('quantity_per_property');
    $quantity_per_physical = $request->input('quantity_per_physical');
    $quantity = $request->input('quantity');
    $value = $request->input('value');
    $total_value = $request->input('total_value');
    $remarks = $request->input('remarks');
    $category = $request->input('category');
    $acquisition_type = $request->input('acquisition_type');
    $grade_level = $request->input('grade_level');


    // Create UserRequest data array
    $userRequestData = [
        'user_id' => $request->user_id,
        'inventory_id' => $inventory->id, // Assigning inventory id
        'status' => $status,
        'school_property' => $schoolProperty,
        'property_number' => $property_number,
        'unit_of_measure' => $unit_of_measure,
        'unit_value' => $unit_value,
        'quantity_per_property' => $quantity_per_property,
        'quantity_per_physical' => $quantity_per_physical,
        'quantity' => $quantity,
        'value' => $value,
        'total_value' => $total_value,
        'remarks' => $remarks,
        'category' => $category,
        'acquisition_type' => $acquisition_type,
        'grade_level' => $grade_level


    ];

    // Create the UserRequest instance
    $userRequest = UserRequests::create($userRequestData);

    if (!$userRequest) {
     return redirect()->route('inventory')->with('error', 'Failed to request item');

    }


    return redirect()->route('inventory')->with('success', 'The item with ID: '.$userRequest->inventory_id.' was REQUESTED successfully!');
}





public function declineRequest($id){
if (Auth::user()){
    $userRequest = UserRequests::find($id);
    $userRequest->status = 'declined';
    $userRequest->save();
    return redirect('/requests')->with('success', 'The request with ID: '.$userRequest->id.' - '.$userRequest->school_property.' was DECLINED!');
    }
    return redirect()->route('dashboard')->with('error', 'You do not have permission to delete a request');
}

public function acceptRequest($id){
    if (Auth::user()->usertype == 'admin'){
        $userRequest = UserRequests::find($id);
        $userRequest->status = 'accepted';
        $userRequest->save();
        return redirect('/requests')->with('success', 'The request with ID: '.$userRequest->id.' - '.$userRequest->school_property.' was ACCEPTED successfully!');
    }
    return redirect()->route('dashboard')->with('error', 'You do not have permission to accept a request');
}

public function cancelledRequest($id){
    if (Auth::user()){
        $userRequest = UserRequests::find($id);
        $userRequest->delete();
        return redirect('/requests')->with('success', 'The request with ID: '.$userRequest->id.' - '.$userRequest->school_property.' was CANCELLED');
        }
        return redirect()->route('dashboard')->with('error', 'You do not have permission to delete a request');
    
    }


public function deleteRequest($id)
{
    if (AAuth::user()->usertype == 'admin'){
        // Fetch the specific request to delete
        $request_history = request_history::find($id); // Find by ID
            $request_history->delete();
            // Redirect with a descriptive success message
            return redirect('requests')->with('success', 'The request');
    
        
    }
    // Handle unauthorized access
    return redirect()->route('dashboard')->with('error', 'You do not have permission to delete a request.');
}






    public function markedAsComplete($id) {
        if (Auth::user()) {
            $userRequest = UserRequests::find($id);
            $userRequest->status = 'completed';
            $userRequest->save();
    
            $inventory = Inventory::find($userRequest->inventory_id);
    
            $inventory->update([
                'quantity' => $inventory->quantity + $userRequest->quantity,
                'total_value' => $inventory->total_value + $userRequest->total_value,
                'quantity_per_physical' => $inventory->quantity_per_physical + $userRequest->quantity_per_physical,
                'quantity_per_property' => $inventory->quantity_per_property + $userRequest->quantity_per_property,
            ]);
    
            $inventory->save();
    
            // Move the completed request to Completed/Declined History
            $this->moveRequestToHistory($userRequest);
    
            // Redirect the user after the request is marked as completed
            return redirect('/requests')->with('success', 'The request with ID: ' . $userRequest->id . ' - ' . $userRequest->school_property . ' was MARKED AS COMPLETED. The new inventory quantity is: ' . $inventory->quantity);
        }
    
        return redirect()->route('dashboard')->with('error', 'You do not have permission to mark a request as completed');
    }

    protected function moveRequestToHistory($userRequest) {
        // Create a new entry in the history table with the same data as the completed request
        request_history::create([
            'user_id' => $userRequest->user_id,
            'inventory_id' => $userRequest->inventory_id,
            'status' => 'completed',
            'school_property' => $userRequest->school_property,
            'property_number' => $userRequest->property_number,
            'unit_of_measure' => $userRequest->unit_of_measure,
            'unit_value' => $userRequest->unit_value,
            'quantity_per_property' => $userRequest->quantity_per_property,
            'quantity_per_physical' => $userRequest->quantity_per_physical,
            'quantity' => $userRequest->quantity,
            'value' => $userRequest->value,
            'total_value' => $userRequest->total_value,
            'remarks' => $userRequest->remarks,
            'category' => $userRequest->category,
            'acquisition_type' => $userRequest->acquisition_type,
            'grade_level' => $userRequest->grade_level,
        ]);
    
        // Delete the completed request from the main requests table
        $userRequest->delete();
    }


public function viewRequest($id)
{
    if (Auth::check()) {
        $request_history = request_history::find($id);
        return view('include.viewRequest', compact('request_history'));
    }
    
    return redirect()->route('login'); // Redirect unauthenticated users to the login page
}

public function dashboard(){
    if (Auth::check()) {
        $UsersRequests = UserRequests::all();
        $Users = User::all();
        $Inventory = Inventory::all();
        $AcceptedRequests = UserRequests::where('status', 'pending')->get();
        $Reports = Report::all();

        return view('dashboard')->with('Reports', $Reports);
    }
    return redirect()->route('login'); // Redirect unauthenticated users to the login page
}




public function submitReport(Request $request)
{
    if(Auth::check()) {
        $users = User::all();
   
    // Validate incoming request data
    $validatedData = $request->validate([
        'item_name' => 'required|string',
        'description' => 'required|string',
        'location' => 'required|string',
    ]);

   
    $report = new Report();
    
    $report->item_name = $validatedData['item_name'];
    $report->description = $validatedData['description'];
    $report->location = $validatedData['location'];
    $report->date_reported = now(); // Assuming you want to timestamp the report submission

    
    $report->save();

    return redirect()->route('reports')->with('success', 'The report submitted');
}
return redirect()->route('login'); // Redirect unauthenticated users to the login page

}

public function reports() {
    if (Auth::check()) {
        $users = User::all();
        // Retrieve all reports
        $reports = Report::all();
        return view('/reports', compact('users', 'reports'));
    }
    return redirect()->route('login'); // Redirect unauthenticated users to the login page
}















    



/////////////add item//////////

function addItem(){
    if (Auth::user()->usertype == 'admin') {
          return view ('include.add_item');
    }
    else if (Auth::user()->usertype == 'user') return redirect(route('dashboard'));

    return redirect()->route('login');
  }

public function addItemPost(Request $request){
    // Validate the incoming request
    $request->validate([
        'school_property' => 'required',
        'property_number' => 'nullable',
        'unit_of_measure' => 'nullable',
        'unit_value' => 'nullable|numeric',
        'quantity_per_property' => 'nullable|integer',
        'quantity_per_physical' => 'nullable|integer',
        'quantity' => 'nullable|integer',
        'value' => 'nullable|numeric',
        'total_value' => 'nullable|numeric',
        'remarks' => 'nullable',
        'category' => 'nullable',
        'acquisition_type' => 'nullable',
        'grade_level' => 'nullable',
    ]);

    // Create a new inventory item using the validated data
    $inventoryData = [
        'school_property' => $request->school_property,
        'property_number' => $request->property_number,
        'unit_of_measure' => $request->unit_of_measure,
        'unit_value' => $request->unit_value,
        'quantity_per_property' => $request->quantity_per_property,
        'quantity_per_physical' => $request->quantity_per_physical,
        'quantity' => $request->quantity,
        'value' => $request->value,
        'total_value' => $request->total_value,
        'remarks' => $request->remarks,
        'category' => $request->category,
        'acquisition_type' => $request->acquisition_type,
        'grade_level' => $request->grade_level,
    ];

    $Inventory = Inventory::create($inventoryData);

    if(!$Inventory){
        return redirect()->route('addItemPage')->with("error", "Failed to add inventory item.");
    }

    return redirect()->route('inventory')->with('success', 'The item with ID: '.$Inventory->id.' - '.$Inventory->school_property.' was ADDED successfully!');
}






}



  



////////
