<?php

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;

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

Route::get('/', function () {
    return view('auth.login');
});

route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['isLogin:admin']], function () {
        route::get('/product', [ProductController::class, 'index'])->name('pageProduct');
        route::get('/search', [ProductController::class, 'search'])->name('search');
        route::post('/product/add', [ProductController::class, 'store'])->name('createProduct');
        route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('deleteProduct');
        route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('editProduct');
        route::put('/product/update/{id}', [ProductController::class, 'update'])->name('updateProduct');
        route::get('/product/stock/{id}', [ProductController::class, 'pageStock'])->name('stockProduct');
        route::post('/product/add/stock/{id}', [ProductController::class, 'updateStock'])->name('updateStock');

        route::get('/dashboard', [AuthController::class, 'pageDashboard'])->name('pageDashboard');
        route::get('/user', [AuthController::class, 'index'])->name('pageUser');
        route::get('/admin', [AuthController::class, 'pageAdmin'])->name('pageAdmin');
        
        route::post('/user/add', [AuthController::class, 'store'])->name('createUser');
        route::put('/user/edit/{id}', [AuthController::class, 'update'])->name('updateUser');
        route::delete('/user/delete/{id}', [AuthController::class, 'destroy'])->name('deleteUser');
        route::get('/purchase', [PurchaseController::class, 'index'])->name('pagePurchase');
        
    });
    Route::group(['middleware' => ['isLogin:employee']], function () {
        route::get('/employee', [AuthController::class, 'pageEmployee'])->name('pageEmployee');
        route::post('/purchase/add', [PurchaseController::class, 'store'])->name('createPurchase');
        route::get('/purchase_employee', [PurchaseController::class, 'pagePurchaseEmployee'])->name('pagePurchaseEmployee');
        route::get('/product_employee', [ProductController::class, 'pageProductEmployee'])->name('pageProductEmployee');
        route::get('/purchase/{id}/download-pdf', [PurchaseController::class, 'downloadPdf'])->name('generate-pdf');
        // route::get('/cetak-purchase', [PurchaseController::class, 'CetakPDF'])->name('generatePDF');
    });
    Route::post('/export-excel',[PurchaseController::class,'downloadExcel'])->name('download-excel');
});

route::middleware('isGuest')->group(function () {
    route::get('/login', [AuthController::class, 'pageLogin'])->name('login');
    route::post('/login', [AuthController::class, 'postLogin'])->name('authLogin');
});
