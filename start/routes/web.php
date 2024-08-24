<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\SaleController; 
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\InvoiceController; 
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DevelopersignupController;
use App\Http\Controllers\DeveloperloginController;

//use App\Http\Controllers\SaleController;
//use App\Http\Controllers\RobotSignsController;

// Route::get('/', function () { return view('welcome'); });
// Index Page to view available books for sale
Route::get('/welcome', function () { return view('welcome'); });

Route::get('/', [BookController::class, 'index'])->name('index');

Route::get('/addbook', [BookController::class, 'addBook'])->name('addbook');
Route::get('/books', [BookController::class, 'listAllBooks'])->name('books');
Route::get('/viewbook/{id}', [BookController::class, 'viewBook'])->name('viewbook');
Route::get('/editbook/{id}', [BookController::class, 'editBook'])->name('editbook');
Route::post('/postbook', [BookController::class, 'postBook'])->name('postbook');
Route::get('/deletebook/{id}', [BookController::class, 'deleteBook'])->name('deletebook');


// customers
Route::get('/addcustomer', [BuyerController::class, 'addCustomer'])->name('addcustomer');
Route::get('/customers', [BuyerController::class, 'listCustomers'])->name('customers');
Route::get('/viewcustomer/{id}', [BuyerController::class, 'viewCustomer'])->name('viewcustomer');
Route::get('/editcustomer/{id}', [BuyerController::class, 'editCustomer'])->name('editcustomer');
Route::post('/postcustomer', [BuyerController::class, 'postCustomer'])->name('postcustomer');
Route::get('/deletecustomer/{id}', [BuyerController::class, 'deleteCustomer'])->name('deletecustomer');

// cart
Route::post('/selectcustomer', [SaleController::class, 'selectCustomer'])->name('selectcustomer');

Route::post('/addcart', [SaleController::class, 'addCart'])->name('addcart');
Route::get('/cart', [SaleController::class, 'viewCart'])->name('cart');
Route::post('/updatecart', [SaleController::class, 'updateCart'])->name('updatecart');
Route::post('/removecartitem', [SaleController::class, 'removeCartItem'])->name('removecartitem');
Route::post('/checkout', [SaleController::class, 'checkout'])->name('checkout');
Route::post('/placeorder', [SaleController::class, 'postOrderRequest'])->name('placeorder');


Route::get('/invoices', [InvoiceController::class, 'invoices'])->name('invoices');
Route::post('/viewinvoice', [InvoiceController::class, 'viewInvoice'])->name('viewinvoice');

Route::get('/sales', [InvoiceController::class, 'sales'])->name('sales');



// Make an order
//Route::get( '/order/{id}', [SaleController::class, 'order'])->middleware(['auth', 'verified'])->name('order');
//Route::post( '/order', [SaleController::class, 'postOrderRequest'])->middleware(['auth', 'verified'])->name('postorder');









Route::post('/login', [DeveloperloginController::class, 'fireLogin'])->name('login');
Route::post('/register', [DevelopersignupController::class, 'signmeup'])->name('register');
Route::get('/register/verify/{token}', [DevelopersignupController::class, 'verify'])->name('verify');

// User Dashboard
// Route::get('/dashboard', function () { return view('dashboard'); })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard', [DeveloperloginController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/signrep', [RobotSignsController::class, 'signmeup'])->name('signrep');
Route::post('/grantrep', [RobotSignsController::class, 'postSignRep'])->name('grantrep');
Route::get('/signadm', [RobotSignsController::class, 'signmeupAdm'])->name('signadm');
Route::post('/grantadm', [RobotSignsController::class, 'postSignAdm'])->name('grantadm');

require __DIR__.'/auth.php';