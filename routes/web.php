<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryitemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TechReportController;
use App\Http\Controllers\TechProfileController;
use App\Http\Controllers\ServicesController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('brand', BrandController::class);
Route::delete('brand/{brand}/delete', [BrandController::class, 'delete'])->name('brand.delete');


Route::resource('category',CategoryController::class);
Route::delete('/category/{category}/delete', [CategoryController::class, 'delete'])->name('category.delete');

Route::resource('inventory',InventoryController::class);
Route::delete('/inventory/{inventory}/delete', [InventoryController::class, 'delete'])->name('inventory.delete');

Route::resource('inventoryitem',InventoryitemController::class);
//Route::get('inventoryitem/create/{product_id}', [InventoryitemController::class, 'create'])->name('inventoryitem.create');
Route::get('inventory/{product_id}/serials', [InventoryitemController::class, 'search'])->name('inventoryitem.serials');
Route::get('/inventory/{product_id}/serials', [InventoryitemController::class, 'showSerials'])->name('inventoryitem.serials');
Route::delete('/inventoryitem/{inventoryitem}/delete', [InventoryitemController::class, 'delete'])->name('inventoryitem.delete');


//service routes
Route::resource('service', ServicesController::class);
// Route::delete('service/{service}/delete', [ServicesController::class, 'service'])->name('service.delete');
Route::get('/service', [ServicesController::class, 'index'])->name('service.index');
Route::delete('/service/{service}', [ServicesController::class, 'delete'])->name('services.delete');


//techprofile routes
Route::resource('techprofile', TechProfileController::class);
Route::get('/techprofile', [TechProfileController::class, 'index'])->name('techprofile.index');
Route::delete('/techprofile/{techprofile}', [TechProfileController::class, 'delete'])->name('techprofile.delete');
Route::get('/techprofile', [TechProfileController::class, 'index'])->name('techprofile.index');

//techreport routes

Route::resource('techreport',TechReportController::class);
Route::get('/techreport', [TechReportController::class, 'index'])->name('techreport.index');
Route::delete('/techreport/{techreport}/delete', [TechReportController::class, 'delete'])->name('techreport.delete');
Route::get('techreport/{techreport}/edit', [TechReportController::class, 'edit'])->name('techreport.edit');

// Route::get('/techreport', [TechReportController::class, 'index'])->name('techreport.index');
// Route::get('techreport', [TechReportController::class, 'index'])->name('techreport.index');



require __DIR__.'/auth.php';
