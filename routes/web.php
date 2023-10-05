<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Customers_Report;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\InvoiceAchiveController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Invoices_Report;
use App\Http\Controllers\InvoicesDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [Dashboard::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});

require __DIR__ . '/auth.php';


Route::resource('invoices', InvoiceController::class);
Route::resource('sections', SectionController::class);
Route::resource('products', ProductController::class);
Route::resource('InvoiceAttachments', InvoiceAttachmentsController::class);

Route::get('section/{id}', [InvoiceController::class, 'getproducts']);
Route::get('/InvoicesDetails/{id}', [InvoicesDetailsController::class, 'edit']);
Route::get('download/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'get_file']);
Route::get('View_file/{invoice_number}/{file_name}', [InvoicesDetailsController::class, 'open_file']);
Route::post('delete_file', [InvoicesDetailsController::class, 'destroy'])->name('delete_file');

Route::get('edit_invoice/{id}', [InvoiceController::class, 'edit']);
Route::get('Status_show/{id}', [InvoiceController::class, 'show'])->name('Status_show');
Route::post('Status_update/{id}', [InvoiceController::class, 'Status_update'])->name('Status_Update');

Route::resource('Archive', InvoiceAchiveController::class);
Route::get('Invoice_Paid', [InvoiceController::class, 'Invoice_Paid']);
Route::get('Invoice_UnPaid', [InvoiceController::class, 'Invoice_UnPaid']);
Route::get('Invoice_Partial', [InvoiceController::class, 'Invoice_Partial']);
Route::get('Print_invoice/{id}', [InvoiceController::class, 'Print_invoice']);

Route::get('invoices_report', [Invoices_Report::class, 'index']);
Route::post('Search_invoices', [Invoices_Report::class, 'Search_invoices']);

Route::get('customers_report', [Customers_Report::class, 'index']);
Route::post('Search_customers', [Customers_Report::class, 'Search_customers']);

Route::get('markasread', [InvoiceController::class, 'markAllAsRead'])->name('markasread');

// in the bottom
Route::get('/{page}', [AdminController::class, 'index']);
