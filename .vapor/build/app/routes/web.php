<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthManager;  // This is the namespace of the controller.
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Models\User;
use App\Models\UserRequests;
use App\Models\Inventory;

//use App\Http\Controllers\AuthManager;  // This is the namespace of the controller.

/*
|--------------------------------------------------------------------------
|Reminder ---  please install laravel/ui in the WEB SERVER IF ERROR OCCURS -- raf 
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
     
        $userRequests = UserRequests::all();
        $users = User::all();
        $inventory = Inventory::all();

        $totalQuantity = Inventory::sum('quantity');
        $totalGCQ = Inventory::where('remarks', 'In Good Condition')->sum('quantity');
        $PendingRequests = UserRequests::where('status', 'pending')->count();
        $reports = Report::all();


        return view('dashboard', compact('userRequests', 'users', 'inventory', 'PendingRequests', 'totalQuantity', 'totalGCQ', 'reports'));
    })->name('dashboard');

    Route::middleware(['userType:admin'])->group(function () {
       
        Route::get('/manage-employees', [AuthManager::class, 'manageEmployees'])->name('manage.employees');
        
    });
    
 
    Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');
});

Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::post('/login', [AuthManager::class, 'loginPost'])->name('login.post');

Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');
Route::post('/registration', [AuthManager::class, 'registrationPost'])->name('registration.post');

Route::get('/manageEmployees', [AuthManager::class, 'manageEmployees'])->name('manageEmployees');
Route::get('/settings', [AuthManager::class, 'settings'])->name('settings');


// Route to edit a user's information
Route::get('edit/{id}', [AuthManager::class, 'edit'])->name('edit');

// Route to delete a user
Route::get('delete/{id}', [AuthManager::class, 'remove'])->name('remove');
Route::put('update-data/{id}', [AuthManager::class, 'update'])->name('update');

//////////////////////////////////////////////// error beyonod this point

/*
Route::controller(AuthManager::class)->group(function(){
    Route::get('users', 'index');
    Route::get('users-export', 'export')->name('users.export');
    Route::post('users-import', 'import')->name('users.import');
});
*/

Route::post('/inventory-import', [InventoryController::class, 'import'])->name('inventory.import');


//Route::controller(AuthManager::class)->group(function(){
  //  Route::get('Inventory', 'index');
  //  Route::post('/inventory-import', [AuthManager::class, 'import'])->name('inventory.import');
//});

Route::get('editInventory/{id}', [AuthManager::class, 'editInventory'])->name('editInventory');
Route::put('updateInventory/{id}', [AuthManager::class, 'updateInventory'])->name('updateInventory');


Route::get('removeConfirm/{id}', [AuthManager::class, 'removeConfirm'])->name('removeConfirm');

Route::get('deleteInventory/{id}', [AuthManager::class, 'removeItem'])->name('deleteInventory');

Route::get('addItem', [AuthManager::class, 'addItem'])->name('addItem');

Route::post('addItemPost', [AuthManager::class, 'addItemPost'])->name('addItemPost');


Route::get('/inventory', [AuthManager::class, 'search_inventory'])->name('inventory');

//Go to request page
Route::get('requests', [AuthManager::class, 'requestPage'])->name('requestPage');



//Go to request details page after clicking request
Route::get('/requestDetails/{id}', [AuthManager::class, 'requestDetails'])->name('requestDetails');


//Button route to add request
Route::post('addRequest', [AuthManager::class, 'addRequest'])->name('addRequest');



Route::get('declineRequest/{id}', [AuthManager::class, 'declineRequest']);
Route::get('cancelledRequest/{id}', [AuthManager::class, 'cancelledRequest']);
Route::get('acceptRequest/{id}', [AuthManager::class, 'acceptRequest']);

Route::put('markedAsComplete/{id}', [AuthManager::class, 'markedAsComplete']);


Route::get('viewRequest/{id}', [AuthManager::class, 'viewRequest']);


Route::get("deleteRequest/{id}", [AuthManager::class, 'deleteRequest']);


Route::get('/reports', [AuthManager::class, 'reports'])->name('reports');

Route::put('submitReport', [AuthManager::class, 'submitReport'])->name('submitReport');