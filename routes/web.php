<?php

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes([
    'verify' => true,
]);

Route::get('/', function () {
    $items = Item::all();
    return view('pages.home', ['items' => $items]);
})->middleware('verified');

Route::get('/home', function () {
    $items = Item::all();
    return view('pages.home', ['items' => $items]);
    return view('pages.home');
})->middleware('verified');;

Route::get('/login', function () {
    return view('pages.sign_in');
})->name('login');

Route::get('/sign_up', function () {
    return view('pages.sign_up');
});

Route::post('/login', [UserController::class, 'login']);

Route::post('/sign_up', [UserController::class, 'register']);

Route::get('/sign_out', [UserController::class, 'sign_out']);

Route::get('/item/{id}', function ($id) {
    $item = Item::find($id);
    return view('pages.item', ['item' => $item, 'user' => Auth::user()]);
})->middleware('verified');

Route::post('/item/addToCart/{id}', [ItemController::class, 'addToCart'])->middleware('verified');
Route::post('/item/deleteFromCart/{id}', [ItemController::class, 'deleteFromCart'])->middleware('verified');

Route::get('/cart', [ItemController::class, 'cart'])->middleware('verified');
Route::get('/profile', [ItemController::class, 'profile'])->middleware('verified');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/checkout/{id}', [ItemController::class, 'checkout'])->middleware('verified');

Route::post('/checkout', [ItemController::class, 'checkoutFromCart'])->middleware('verified');
