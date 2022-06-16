<?php

use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\Route;



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/detail/{id}', [App\Http\Controllers\DetailController::class, 'index'])->name('detail');
Route::get('/all-product', [App\Http\Controllers\HomeController::class, 'allProduct'])->name('all-product');
Route::resource('forgot-password', '\App\Http\Controllers\ForgotPasswordController');




Auth::routes();

Route::group(['prefix' => 'checkout', 'namespace' => 'Checkout', 'middleware' => 'auth'], function() {

    Route::get('/profil', [App\Http\Controllers\HomeController::class, 'profil'])->name('profil');
    Route::get('/profil/edit/{id}', [App\Http\Controllers\HomeController::class, 'editProfil'])->name('edit-profil');
    Route::post('/profil/edit/data/{id}', [App\Http\Controllers\HomeController::class, 'editDataProfil'])->name('edit-data-profil');
    Route::get('/', function() { return view('pages.checkout'); })->name('checkout');
    Route::get('/cart', [App\Http\Controllers\CheckoutController::class, 'showCart'])->name('cart');
    Route::get('/cart/remove/{id}', [App\Http\Controllers\CheckoutController::class, 'remove'])->name('remove');
    Route::post('/cart/add/{id}', [App\Http\Controllers\CheckoutController::class, 'addToCart'])->name('checkout-add-to-cart');
    Route::post('/cart/update/{id}', [App\Http\Controllers\CheckoutController::class, 'updateInCart'])->name('update-cart');


    //proses pembayaran
    Route::get('/process/{id}', [App\Http\Controllers\CheckoutController::class, 'process'])->name('checkout-payment-process');
    Route::post('/process/{id}', [App\Http\Controllers\CheckoutController::class, 'processData'])->name('checkout-payment-process-send');
    //success
    Route::get('/success', [App\Http\Controllers\CheckoutController::class, 'successConfirm'])->name('checkout-payment-process-confirm');

    //pesanan saya
    Route::get('/pesanan-saya/detail/{id}', [App\Http\Controllers\HomeController::class, 'orderHistoryDetail'])->name('my-order-detail');
    Route::get('/review/{id}', [App\Http\Controllers\HomeController::class, 'reviewProduct'])->name('review-product');
    Route::post('/review/{id}', [App\Http\Controllers\HomeController::class, 'reviewProductSubmit'])->name('review-product-submit');
    Route::get('/produk/review/{id}', [App\Http\Controllers\HomeController::class, 'listReviewProduct'])->name('list-product-review');
    Route::post('/pesanan-saya/{id}', [App\Http\Controllers\HomeController::class, 'myOrderIsDone'])->name('my-order-done');
    Route::get('/pesanan-saya/{id}', [App\Http\Controllers\HomeController::class, 'orderHistory'])->name('order-history');


});


Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth','role'])
    ->group(function(){
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'] )->name('dashboard');
        Route::get('/profil/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'profil'] )->name('profil-admin');
        Route::get('/profil/edit/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'editProfil'] )->name('edit-profil-admin');
        Route::post('/profil/edit/{id}', [App\Http\Controllers\Admin\DashboardController::class, 'editProfilSubmit'] )->name('edit-profil-admin-submit');

        Route::get('/data-pembeli', [App\Http\Controllers\Admin\BuyerDataController::class, 'index'] )->name('data-pembeli');

        Route::resource('transaction', '\App\Http\Controllers\Admin\TransactionController' );
        Route::get('transaction/expedition&resi/{id}', [App\Http\Controllers\Admin\TransactionController::class, 'showFormExpedition'] )->name('Form-Expedition');
        Route::get('transaction/detail/{id}', [App\Http\Controllers\Admin\TransactionController::class, 'transactionDetail'] )->name('transaction-detail');
        Route::post('transaction/expedition&resi/{id}/add', [App\Http\Controllers\Admin\TransactionController::class, 'storeExpedition'] )->name('Store-Form-Expedition');

        Route::get('/report', [App\Http\Controllers\Admin\TransactionController::class, 'report'] )->name('report');
        Route::get('/report/export-pdf', [App\Http\Controllers\Admin\TransactionController::class, 'exportPdf'] )->name('export-pdf');

        Route::resource('modal-produksi', '\App\Http\Controllers\Admin\ProductionCapital' );
        Route::get('/modal/export-pdf', [App\Http\Controllers\Admin\ProductionCapital::class, 'exportPDFModal'] )->name('modal-export-to-pdf');
        Route::resource('review', '\App\Http\Controllers\Admin\ReviewController' );


        Route::resource('data-produk', '\App\Http\Controllers\Admin\ProductController' );
        Route::resource('gallery', '\App\Http\Controllers\Admin\GalleryController' );

        Route::get('/transaksi', function () {
            return view('pages.admin.transaksi');
        })->name('data-transaksi');
    });


//Helper
Route::get('/info', function() { return view('info'); });
// Route::get('/logout', function() { return redirect('/'); });
Route::get('/detail', function() { return redirect('/'); });

