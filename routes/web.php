<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DescriptionController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RemittanceController;
use App\Http\Controllers\RemittanceItemController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WhtController;
use App\Models\Wht;
use Illuminate\Support\Facades\Route;

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

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', function () {
        return view('dashboard.dashboard');
    })->name('dashboard');

    Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');
    Route::get('/invoice/{invoice:invoice_no}/detail', [InvoiceController::class, 'detail'])->name('invoice.detail');
    Route::get('/invoice/{invoice:invoice_no}/print', [InvoiceController::class, 'print'])->name('invoice.print');
    Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoice.create');
    Route::post('/invoice/create', [InvoiceController::class, 'store'])->name('invoice.store');
    Route::get('/invoice/{invoice:invoice_no}/settings', [InvoiceController::class, 'edit'])->name('invoice.edit');
    Route::patch('/invoice/{invoice:invoice_no}/update', [InvoiceController::class, 'update'])->name('invoice.update');

    Route::get('/remittance', [RemittanceController::class, 'index'])->name('remittance');
    Route::get('/remittance/create', [RemittanceController::class, 'create'])->name('remittance.create');
    Route::post('/remittance/create', [RemittanceController::class, 'store'])->name('remittance.store');
    Route::get('/remittance/{remittance:remittance_no}/detail', [RemittanceController::class, 'detail'])->name('remittance.detail');

    Route::get('/getInvoices/{client}', [RemittanceController::class, 'getInvoices']);
    Route::get('/getWht/{client}', [RemittanceController::class, 'getWht']);

    Route::post('/remittance-item/{remittance:remittance_no}/add', [RemittanceItemController::class, 'store'])->name('remittance-item.add');

    Route::post('/item/{invoice}/add', [ItemController::class, 'store'])->name('item.add');
    Route::patch('/item/update', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/item/{item}/delete', [ItemController::class, 'destroy'])->name('item.delete');

    Route::post('/description/{invoice}/add', [DescriptionController::class, 'store'])->name('description.add');
    Route::patch('/description/update', [DescriptionController::class, 'update'])->name('description.update');
    Route::delete('/description/{invoice}/delete', [DescriptionController::class, 'destroy'])->name('description.delete');

    Route::post('/invoice/{invoice:invoice_no}/attachment', [AttachmentController::class, 'store'])->name('attachment.add');
    Route::delete('/invoice/attachment/{attachment}/delete', [AttachmentController::class, 'destroy'])->name('attachment.delete');

    Route::get('/wht', [WhtController::class, 'index'])->name('wht');
    Route::get('/wht/create', [WhtController::class, 'create'])->name('wht.create');
    Route::post('/wht/create', [WhtController::class, 'store'])->name('wht.store');

    Route::get('/client', [ClientController::class, 'index'])->name('client');
    Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('/client/create', [ClientController::class, 'store'])->name('client.store');
    Route::get('/client/{client}/edit', [ClientController::class, 'edit'])->name('client.edit');
    Route::post('/client/{client}/edit', [ClientController::class, 'update'])->name('client.update');
    Route::delete('/client/{client}/delete', [ClientController::class, 'destroy'])->name('client.delete');

    Route::get('/bank-account', [BankController::class, 'index'])->name('bank');
    Route::get('/bank-account/create', [BankController::class, 'create'])->name('bank.create');
    Route::post('/bank-account/create', [BankController::class, 'store'])->name('bank.store');
    Route::get('/bank-account/{bank}/edit', [BankController::class, 'edit'])->name('bank.edit');
    Route::post('/bank-account/{bank}/edit', [BankController::class, 'update'])->name('bank.update');
    Route::delete('/bank-account/{bank}/delete', [BankController::class, 'destroy'])->name('bank.delete');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/create', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])->name('users.delete');

    Route::get('/services', [ServicesController::class, 'index'])->name('services');
    Route::post('/services/add', [ServicesController::class, 'store'])->name('service.add');
    Route::post('/services/update', [ServicesController::class, 'update'])->name('service.update');
    Route::delete('/services/{services}/delete', [ServicesController::class, 'destroy'])->name('service.destroy');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/report', function () {
        return view('report.report');
    });
});
