<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Customer\CustomerIndexController;
use App\Http\Controllers\Customer\CustomerMatchesController;
use App\Http\Controllers\Matches\MatchesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\TicketViewController;
use App\Http\Controllers\TransactionController;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', [IndexController::class, 'index'])->name('admin.index');

// Admins
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth', 'verified', 'role:admin']) // Only for authenticated, verified, and admin role
    ->name('admin.')                                // Route names will be like admin.index, admin.roles.index
    ->prefix('admin')                               // URL will be like /admin/
    ->group(function () {
        Route::get('/', [IndexController::class, 'index'])->name('index'); // admin.index => /admin
        Route::get('/user-role-counts', [IndexController::class, 'getUserRoleCounts'])->name('user-role-counts');
        Route::resource('roles', RoleController::class);                   // admin.roles.*
        Route::resource('permissions', PermissionController::class);       // admin.permissions.*

        Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
        Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('permissions/{permission}/roles', [PermissionController::class, 'assignrole'])->name('permissions.roles');
        Route::delete('permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.remove');
        Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
        Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
        Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
        Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'RevokePermission'])->name('users.permissions.revoke');
    });

// In routes/web.php
Route::post('/user/update-status', [UserController::class, 'updateStatus'])->name('user.update-status');
Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.create');
Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');

// Routes for all Transactions to Admins page
Route::get('/admin/transactions', [TransactionController::class, 'admintransactions'])->name('admin.transactions');
Route::delete('/admin/transactions/{id}', [TransactionController::class, 'destroy'])->name('admin.transactions.destroy');



//Admin Routes in adding matches
Route::middleware('auth')->group(function(){
    Route::get('/matches',[MatchesController::class,'index'])->name('matches.index');
      Route::get('/matches/show',[MatchesController::class,'show'])->name('matches.show');
       Route::post('/matches/store',[MatchesController::class,'store'])->name('matches.store');
          Route::get('/matches/{id}',[MatchesController::class,'edit'])->name('matches.edit');
          Route::put('/matches/update/{id}',[MatchesController::class,'update'])->name('matches.update');
          Route::put('/matches/delete/{id}',[MatchesController::class,'delete'])->name('matches.delete');
});
//Customer Routes
Route::middleware('auth')->group(function(){
    Route::get('/customer/index',[CustomerIndexController::class,'index'])->name('customer.index');
    Route::get('/customer/matches',[CustomerMatchesController::class,'matchindex'])->name('customer.matches.index');
    Route::get('/customer/suggestion',[SuggestionController::class,'suggestion'])->name('customer.suggestions');
});

Route::middleware('auth')->group(function(){
    Route::post('/customer/suggestion/post', [SuggestionController::class,'post'])->name('customer.suggestions.store');
        Route::get('/admin/suggestion', [SuggestionController::class,'adminsuggestions'])->name('admin.suggestions');
                Route::get('/admin/suggestion/{id}', [SuggestionController::class,'adminsuggestionsdelete'])->name('admin.suggestions.delete');
});

//Profile controllers
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Ticket and Price Management controllers
Route::middleware('auth')->group(function(){
    Route::get('/admin/tickets', [TicketViewController::class, 'index'])->name('admin.tickets.index');
Route::get('/admin/tickets/create', [TicketViewController::class, 'create'])->name('admin.tickets.create');
Route::post('/admin/tickets/store', [TicketViewController::class, 'store'])->name('admin.tickets.store');
Route::get('/admin/tickets/{id}/edit', [TicketViewController::class, 'edit'])->name('admin.tickets.edit');
Route::put('/admin/tickets/{id}/update', [TicketViewController::class, 'update'])->name('admin.tickets.update');
Route::post('/admin/ticket-classes', [TicketViewController::class, 'storeClass'])->name('admin.ticket-classes.store');
});


// Customer Ticket Booking
Route::get('/book-ticket', [TransactionController::class, 'showBookingForm'])->name('ticket.form');
Route::post('/book-ticket', [TransactionController::class, 'storeBooking'])->name('ticket.store');
Route::get('/get-price-by-class/{class_id}', [TransactionController::class, 'getTicketPrice']);
Route::post('/book-ticket', [TransactionController::class, 'store'])->name('ticket.store');


//BookingHistory routes
Route::get('/booking-history', [TransactionController::class, 'bookingHistory'])->name('booking.history');
Route::delete('/booking-history/{id}', [TransactionController::class, 'deleteHistory'])->name('booking.history.delete');




require __DIR__.'/auth.php';
