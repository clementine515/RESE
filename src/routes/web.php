<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Laravel\Fortify\Fortify;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\VerificationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->name('verification.resend');

Route::get('/', [RestaurantController::class, 'beforeLogin'])->name('toppage_before_login');

Route::middleware(['auth'])->group(function (){
    Route::get('/toppage_logged_in', [RestaurantController::class, 'index'])->name('toppage_logged_in');
    Route::get('/detail/{shop_id}', [RestaurantController::class, 'show'])->name('shop_detail');
    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    });
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/create-manager', [AdminController::class, 'showCreateManagerForm'])->name('admin.createManagerForm');
    Route::post('/admin/create-manager', [AdminController::class, 'createManager'])->name('admin.createManager');
    Route::get('/admin/done-admin', [AdminController::class, 'done'])->name('admin.done');
    Route::get('/admin/send-email', [AdminController::class, 'showSendEmailForm'])->name('admin.sendEmailForm');
    Route::post('/admin/send-email', [AdminController::class, 'sendEmail'])->name('admin.sendEmail');
    Route::get('/admin/sent', [AdminController::class, 'sent'])->name('admin.sent');
    Route::get('/admin/csv-import', [AdminController::class, 'showCsvImportForm'])->name('admin.csvImportForm');
    Route::post('/admin/csv-import', [AdminController::class, 'importCsv'])->name('admin.importCsv');
    Route::get('/toppage_after_login', [RestaurantController::class, 'index'])->name('toppage_after_login');
    Route::get('/admin/review/{review_id}/destroy', [AdminController::class, 'destroyReview'])->name('admin.review.destroy');
});

Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager');
    Route::get('/manager/choose-shop', [ManagerController::class, 'chooseShop'])->name('manager.chooseShop');
    Route::get('/manager/create-shop', [ManagerController::class, 'showCreateShopForm'])->name('manager.createShopForm');
    Route::post('/manager/create-shop', [ManagerController::class, 'createShop'])->name('manager.createShop');
    Route::get('/manager/edit-shop/{id}', [ManagerController::class, 'editShop'])->name('manager.editShop');
    Route::put('/manager/update-shop/{id}', [ManagerController::class, 'updateShop'])->name('manager.updateShop');
    Route::get('/manager/done-manager', [ManagerController::class, 'done'])->name('manager.done');
    Route::get('/manager/check-shop', [ManagerController::class, 'checkShop'])->name('manager.checkShop');
    Route::get('/manager/check-reservation/{restaurantId}', [ManagerController::class, 'checkReservation'])->name('manager.checkReservation');
});


Fortify::verifyEmailView(function () {
    return view('auth.verify-email');
});

Fortify::createUsersUsing(\App\Actions\Fortify\CreateNewUser::class);

Route::get('/thanks', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware(['auth'])
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register');

Route::get('/show-modal', function () {
    Session::put('showModal', true);
    return redirect('/');
});

Route::get('/hide-modal', function () {
    Session::forget('showModal');
    return redirect('/');
});

Route::get('restaurants/{restaurantId}/reservations/create', [ReservationController::class, 'create'])->name('reservations.create');

Route::post('reservations', [ReservationController::class, 'store'])->name('reservations.store');

Route::get('stripe/payment', [PaymentController::class, 'handlePayment'])->name('stripe.payment');

Route::view('/done', 'done')->name('done');

Route::get('/search', [RestaurantController::class, 'search'])->name('search_restaurants');

Route::get('/mypage', [ReservationController::class, 'myPage'])->name('mypage');

Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])->name('reservation.destroy');

Route::post('/like/toggle', [RestaurantController::class, 'toggle'])->name('like.toggle');

Route::get('/review-form/{restaurant_id}', [ReservationController::class, 'showReviewForm'])->name('review-form');

Route::get('/reservations/{id}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');

Route::put('/reservations/{id}', [ReservationController::class, 'update'])->name('reservations.update');

Route::get('/reservations/{id}/qrcode', [ReservationController::class, 'generateQRCode'])->name('reservations.qrcode');

Route::get('restaurants/{id}/save-image', [RestaurantController::class, 'saveImage'])->name('restaurants.saveImage');

Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');

Route::get('/reviews/{id}/edit', [ReviewController::class, 'edit'])->name('review.edit');

Route::put('/reviews/{id}', [ReviewController::class, 'update'])->name('review.update');

Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('review.delete');

Route::get('/restaurants/{restaurant_id}/reviews', [ReviewController::class, 'showAllReviews'])->name('reviews.all');