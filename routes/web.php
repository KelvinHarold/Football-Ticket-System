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
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController; 
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\User;
use App\Models\TicketClass;
use App\Models\TicketPrice;


Route::middleware(['auth', 'prevent-back-history'])->group(function () {
    Route::get('/customer/index', [CustomerIndexController::class, 'index'])->name('customer.index');
    Route::get('/admin', [IndexController::class, 'index'])->name('admin.index');
});

Route::get('/', [WelcomeController::class, 'index']);



Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->hasRole('admin')) {
        $transactionsCount = Transaction::count();
        $usersCount = User::count(); 

        $vipClass = TicketClass::where('name', 'VIP')->first();
        $generalClass = TicketClass::where('name', 'General')->first();

        $vipTicketsCount = $vipClass
            ? TicketPrice::where('class_id', $vipClass->id)->count()
            : 0;

        $generalTicketsCount = $generalClass
            ? TicketPrice::where('class_id', $generalClass->id)->count()
            : 0;

        return view('admin.index', compact(
            'transactionsCount',
            'vipTicketsCount',
            'generalTicketsCount',
            'usersCount'
        ));
    } elseif ($user->hasRole('customer')) {
        return view('customer.index');
    }

    return abort(403);
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'verified', 'role:admin']) 
    ->name('admin.')                                
    ->prefix('admin')                               
    ->group(function () {
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
Route::middleware('auth')->group(function () {
    Route::get('/matches', [MatchesController::class, 'index'])->name('matches.index');
    Route::get('/matches/show', [MatchesController::class, 'show'])->name('matches.show');
    Route::post('/matches/store', [MatchesController::class, 'store'])->name('matches.store');
    Route::get('/matches/{id}', [MatchesController::class, 'edit'])->name('matches.edit');
    Route::put('/matches/update/{id}', [MatchesController::class, 'update'])->name('matches.update');
    Route::put('/matches/delete/{id}', [MatchesController::class, 'delete'])->name('matches.delete');
    Route::post('/pastmatches/store', [MatchesController::class, 'savePastMatch'])->name('pastmatches.store');
    Route::delete('/clear', [MatchesController::class, 'clear'])->name('matches.clear');
    Route::get('/past', [MatchesController::class, 'past'])->name('matches.past');
});

//Admin Suggestions view
Route::middleware('auth')->group(function () {
    Route::post('/customer/suggestion/post', [SuggestionController::class, 'post'])->name('customer.suggestions.store');
    Route::get('/admin/suggestion', [SuggestionController::class, 'adminsuggestions'])->name('admin.suggestions');
    Route::get('/admin/suggestion/{id}', [SuggestionController::class, 'adminsuggestionsdelete'])->name('admin.suggestions.delete');
});

// Admin Ticket and Price Management controllers
Route::middleware('auth')->group(function () {
    Route::get('/admin/tickets', [TicketViewController::class, 'index'])->name('admin.tickets.index');
    Route::get('/admin/tickets/create', [TicketViewController::class, 'create'])->name('admin.tickets.create');
    Route::post('/admin/tickets/store', [TicketViewController::class, 'store'])->name('admin.tickets.store');
    Route::get('/admin/tickets/{id}/edit', [TicketViewController::class, 'edit'])->name('admin.tickets.edit');
    Route::put('/admin/tickets/{id}/update', [TicketViewController::class, 'update'])->name('admin.tickets.update');
    Route::delete('/admin/tickets/{id}', [TicketViewController::class, 'destroy'])->name('admin.tickets.delete');
    Route::post('/admin/ticket-classes', [TicketViewController::class, 'storeClass'])->name('admin.ticket-classes.store');
});Route::delete('/admin/transactions/clear', [TransactionController::class, 'clearAll'])->name('admin.transactions.clear');



//Customer Routes
Route::middleware('auth')->group(function () {
    Route::get('/customer/matches', [CustomerMatchesController::class, 'matchindex'])->name('customer.matches.index');
     Route::get('/customer/home', [CustomerMatchesController::class, 'home'])->name('customer.home');
    Route::get('/customer/suggestion', [SuggestionController::class, 'suggestion'])->name('customer.suggestions');
    Route::get('/customer/pastmatches', [MatchesController::class, 'Pastmatches'])->name('customer.pastmatches');
});

Route::get('/profile', [MatchesController::class, 'clear'])->name('matches.clear');

//Profile controllers
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




// Customer Ticket Booking
Route::get('/book-ticket', [TransactionController::class, 'showBookingForm'])->name('ticket.form');
Route::post('/book-ticket', [TransactionController::class, 'storeBooking'])->name('ticket.store');
Route::get('/get-price-by-class/{class_id}', [TransactionController::class, 'getTicketPrice']);
Route::post('/book-ticket', [TransactionController::class, 'store'])->name('ticket.store');


//Customer BookingHistory routes
Route::get('/booking-history', [TransactionController::class, 'bookingHistory'])->name('booking.history');
Route::delete('/booking-history/{id}', [TransactionController::class, 'deleteHistory'])->name('booking.history.delete');

// report controller
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/sales-report', [TransactionController::class, 'salesReport'])->name('admin.sales.report');
});



//new
Route::get('/admin/sales-report/download', [TransactionController::class, 'downloadSalesReport'])->name('admin.sales-report.download');


//profile route
Route::patch('/profile/upload', [ProfileController::class, 'uploaded'])->name('profile.upload');

require __DIR__ . '/auth.php';
