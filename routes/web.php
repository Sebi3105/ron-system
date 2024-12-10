<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryitemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TechReportController;
use App\Http\Controllers\TechProfileController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ActivityLogController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use Spatie\Activitylog\Models\Activity;

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
    
    Route::resource('brand', BrandController::class);
    Route::get('/brands/data', [BrandController::class, 'brandData'])->name('brand.data');
    Route::delete('brand/{brand}/delete', [BrandController::class, 'delete'])->name('brand.delete');

    Route::resource('customer',CustomerController::class);
    Route::delete('customer/{customer}/delete', [CustomerController::class, 'delete'])->name('customer.delete');
    Route::get('/customer/{customer}/customerphistory',[CustomerController::class, 'showHistory'])->name('customer.history');

    Route::resource('category',CategoryController::class);
    Route::get('/categories/data', [CategoryController::class, 'categoryData'])->name('category.data');
    Route::delete('/category/{category}/delete', [CategoryController::class, 'delete'])->name('category.delete');

    Route::resource('inventory',InventoryController::class);
    Route::delete('/inventory/{inventory}/delete', [InventoryController::class, 'delete'])->name('inventory.delete');

    Route::resource('inventoryitem',InventoryitemController::class);
    Route::get('inventoryitem/create/{product_id}', [InventoryitemController::class, 'create'])->name('inventoryitem.create');
    Route::get('inventory/{product_id}/serials', [InventoryitemController::class, 'search'])->name('inventoryitem.serials');
    Route::get('/inventory/{product_id}/serials', [InventoryitemController::class, 'showSerials'])->name('inventoryitem.serials');
    Route::delete('/inventoryitem/{inventoryitem}/delete', [InventoryitemController::class, 'delete'])->name('inventoryitem.delete');


    //service routes
    Route::resource('service', ServicesController::class);
    // Route::delete('service/{service}/delete', [ServicesController::class, 'service'])->name('service.delete');
    Route::get('/service', [ServicesController::class, 'index'])->name('service.index');
    Route::delete('/service/{service}', [ServicesController::class, 'delete'])->name('service.delete');


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
    Route::get('techreport/{techreport}/view', [TechReportController::class, 'view'])->name('techreport.view');

    // Route::get('/techreport', [TechReportController::class, 'index'])->name('techreport.index');
    // Route::get('techreport', [TechReportController::class, 'index'])->name('techreport.index');

    //sales routes
    Route::resource('sales',SalesController::class);
    Route::delete('/sales/{sale}/delete', [SalesController::class, 'destroy'])->name('sales.delete'); // Custom delete route
    Route::get('/sales/{id}', [SalesController::class, 'show'])->name('sales.show');
    Route::get('/sales/serials/{id}', [SalesController::class, 'getSerials'])->name('sales.serials');


    Route::resource('notification',NotificationController::class);
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification.index');

    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/edit-user/{id}', [AdminController::class, 'edit'])->name('admin.edit ');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'delete'])->name('admin.delete ');
    Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/delete/{id}', [AdminController::class, 'destroy'])->name('admin.delete');
    Route::get('/admin/sales/soft-deleted', [SalesController::class, 'softDeleted'])->name('admin.sales.softDeleted');
    Route::get('/admin/brand/soft-deleted', [BrandController::class, 'softDeleted'])->name('admin.brand.softDeleted');
    Route::get('/admin/category/soft-deleted', [CategoryController::class, 'softDeleted'])->name('admin.category.softDeleted');
    // Inventory admin history routes
    Route::get('/admin/inventory/soft-deleted', [InventoryController::class, 'softDeleted'])->name('admin.inventory.softDeleted');
    Route::patch('/admin/inventory/restore/{product_id}', [InventoryController::class, 'restore'])->name('admin.inventory.restore');
    Route::delete('/admin/inventory/force-delete/{product_id}', [InventoryController::class, 'forceDelete'])->name('admin.inventory.forceDelete');

    // Inventory item admin history routes
    Route::get('/admin/inventoryitem/soft-deleted', [InventoryitemController::class, 'softDeletedItems'])->name('admin.inventoryitem.softDeleted');
    Route::patch('/admin/inventoryitem/restore/{sku_id}', [InventoryitemController::class, 'restoreItem'])->name('admin.inventoryitem.restore');
    Route::delete('/admin/inventoryitem/force-delete/{sku_id}', [InventoryitemController::class, 'forceDeleteItem'])->name('admin.inventoryitem.forceDelete');
    //Customer admin history routes
    Route::get('/admin/customer/soft-deleted', [CustomerController::class, 'softDeleted'])->name('admin.customer.soft_deleted');
    Route::patch('/admin/customer/restore/{customer_id}', [CustomerController::class, 'restore'])->name('admin.customer.restore');
    Route::delete('/admin/customer/force-delete/{customer_id}', [CustomerController::class, 'forceDelete'])->name('admin.customer.forceDelete');
    //sales
    Route::get('/admin/sales/soft_deleted', [SalesController::class, 'softDeleted'])->name('admin.sales.soft_deleted');
    Route::patch('/admin/sales/restore/{sales_id}', [SalesController::class, 'restore'])->name('admin.sales.restore');
    Route::delete('/admin/sales/force-delete/{sales_id}', [SalesController::class, 'forceDelete'])->name('admin.sales.forceDelete');
    //category
    Route::get('/admin/category/soft-deleted', [CategoryController::class, 'softDeleted'])->name('admin.category.soft_deleted');
    Route::patch('/admin/category/restore/{category_id}', [CategoryController::class, 'restore'])->name('admin.category.restore');
    Route::delete('/admin/category/force-delete/{category_id}', [CategoryController::class, 'forceDelete'])->name('admin.category.forceDelete');
    //brand
    Route::get('/admin/brand/soft-deleted', [BrandController::class, 'softDeleted'])->name('admin.brand.soft_deleted');
    Route::patch('/admin/brand/restore/{brand_id}', [BrandController::class, 'restore'])->name('admin.brand.restore');
    Route::delete('/admin/brand/force-delete/{brand_id}', [BrandController::class, 'forceDelete'])->name('admin.brand.forceDelete');

    Route::get('/activitylogs', [ActivityLogController::class, 'showLogs']);
});




require __DIR__.'/auth.php';