<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication Route
Route::prefix('auth')->group(function(){
    Route::get('/init', [
        'uses' => 'API\AuthController@init',
        'as' => 'auth.init'
    ])->middleware('auth:api');

    Route::post('/login', [
        'uses' => 'API\AuthController@login',
        'as' => 'auth.login'
    ]);

    Route::post('/register', [
        'uses' => 'API/AuthController@register',
        'as' => 'auth.register'
    ]);

    Route::get('/logout', [
        'uses' => 'API\AuthController@logout',
        'as' => 'auth.logout'
    ])->middleware('auth:api');
});

// User Routes
Route::group(['prefix' => 'user', 'middleware' => ['auth:api', 'user.maintenance']], function(){
    Route::get('/index', [
        'uses' => 'API\UserController@index',
        'as' => 'user.index',
    ]);

    Route::get('/create', [
        'uses' => 'API\UserController@create',
        'as' => 'user.create',
    ]);

    Route::post('/store', [
        'uses' => 'API\UserController@store',
        'as' => 'user.store',
    ]);

    Route::get('/edit/{id}', [
        'uses' => 'API\UserController@edit',
        'as' => 'user.edit',
    ]);

    Route::post('/update/{id}', [
        'uses' => 'API\UserController@update',
        'as' => 'user.update',
    ]);

    Route::post('/update_profile/{id}', [
        'uses' => 'API\UserController@update_profile',
        'as' => 'user.update_profile',
    ]);

    Route::post('/delete', [
        'uses' => 'API\UserController@delete',
        'as' => 'user.delete',
    ]);

    Route::get('/roles_permissions', [
        'uses' => 'API\UserController@userRolesPermissions',
        'as' => 'user.roles_permissions',
    ]);

});

// Product Routes
Route::group(['prefix' => 'product', 'middleware' => ['auth:api', 'product.maintenance']], function(){
    Route::get('/index', [
        'uses' => 'API\ProductController@index',
        'as' => 'product.index',
    ]);

    Route::get('/create', [
        'uses' => 'API\ProductController@create',
        'as' => 'product.create',
    ]);

    Route::post('/store', [
        'uses' => 'API\ProductController@store',
        'as' => 'product.store',
    ]);

    Route::get('/edit/{id}', [
        'uses' => 'API\ProductController@edit',
        'as' => 'product.edit',
    ]);

    Route::post('/update/{id}', [
        'uses' => 'API\ProductController@update',
        'as' => 'product.update',
    ]);

    Route::post('/delete', [
        'uses' => 'API\ProductController@delete',
        'as' => 'product.delete',
    ]);

    Route::post('/search_model', [
        'uses' => 'API\ProductController@search_model',
        'as' => 'product.search_model',
    ]);

});

// Product Export Route
Route::get('/product/export/{id}', [
    'uses' => 'API\ProductController@export',
    'as' => 'product.export',
])->middleware(['product.maintenance']);

// Inventory Reconciliation Route
Route::group(['prefix' => 'inventory_reconciliation', 'middleware' => ['auth:api', 'inventory_reconciliation.maintenance']], function(){
    Route::get('/index', [
        'uses' => 'API\InventoryReconciliationController@index',
        'as' => 'inventory_reconciliation.index',
    ]);

    Route::get('/create', [
        'uses' => 'API\InventoryReconciliationController@create',
        'as' => 'inventory_reconciliation.create',
    ]);

    Route::post('/store', [
        'uses' => 'API\InventoryReconciliationController@store',
        'as' => 'inventory_reconciliation.store',
    ]);

    Route::get('/edit/{id}', [
        'uses' => 'API\InventoryReconciliationController@edit',
        'as' => 'inventory_reconciliation.edit',
    ]);

    Route::post('/update/{id}', [
        'uses' => 'API\InventoryReconciliationController@update',
        'as' => 'inventory_reconciliation.update',
    ]);

    Route::post('/delete', [
        'uses' => 'API\InventoryReconciliationController@delete',
        'as' => 'inventory_reconciliation.delete',
    ]);

    Route::get('/discrepancy/{id}', [
        'uses' => 'API\InventoryReconciliationController@discrepancy',
        'as' => 'inventory_reconciliation.discrepancy',
    ]);
    Route::get('/breakdown/{id}', [
        'uses' => 'API\InventoryReconciliationController@breakdown',
        'as' => 'inventory_reconciliation.breakdown',
    ]);

    Route::post('/import', [
        'uses' => 'API\InventoryReconciliationController@import',
        'as' => 'inventory_reconciliation.import',
    ]);

    Route::post('/export', [
        'uses' => 'API\InventoryReconciliationController@export',
        'as' => 'inventory_reconciliation.export',
    ]);

    Route::post('/unreconcile/list', [
        'uses' => 'API\InventoryReconciliationController@unreconciled_list',
        'as' => 'inventory_reconciliation.unreconciled_list',
    ]);

    Route::post('/reconcile', [
        'uses' => 'API\InventoryReconciliationController@reconcile',
        'as' => 'inventory_reconciliation.reconcile',
    ]);
});

// Employee Routes
Route::group(['prefix' => 'employee', 'middleware' => ['auth:api', 'employee.maintenance']], function(){
    Route::get('/index', [
        'uses' => 'API\EmployeeController@index',
        'as' => 'employee.index',
    ]);

    Route::get('/list/view/{id}', [
        'uses' => 'API\EmployeeController@list_view',
        'as' => 'employee.list.view',
    ]);

    Route::get('/create', [
        'uses' => 'API\EmployeeController@create',
        'as' => 'employee.create',
    ]);

    Route::post('/store', [
        'uses' => 'API\EmployeeController@store',
        'as' => 'employee.store',
    ]);

    Route::get('/edit/{id}', [
        'uses' => 'API\EmployeeController@edit',
        'as' => 'employee.edit',
    ]);

    Route::post('/update/{id}', [
        'uses' => 'API\EmployeeController@update',
        'as' => 'employee.update',
    ]);

    Route::post('/import_employee/{id}', [
        'uses' => 'API\EmployeeController@import_employee',
        'as' => 'employee.import'
    ]);

    Route::post('/delete', [
        'uses' => 'API\EmployeeController@delete',
        'as' => 'employee.delete'
    ]);

});

// Employee Export Route
Route::get('/employee/export_employee/{id}', [
    'uses' => 'API\EmployeeController@export_employee',
    'as' => 'employee.export',
])->middleware(['employee.maintenance']);

// Training Files Route
Route::group(['prefix' => 'training', 'middleware' => ['auth:api', 'training_file.maintenance']], function(){
    Route::get('/files', [
        'uses' => 'API\TrainingController@files',
        'as' => 'training.files'
    ]);

    Route::get('/user_files', [
        'uses' => 'API\TrainingController@user_files',
        'as' => 'training.user_files'
    ]);

    Route::post('/file/upload', [
        'uses' => 'API\TrainingController@file_upload',
        'as' => 'training.file.upload'
    ]);

    Route::post('/file/update/{id}', [
        'uses' => 'API\TrainingController@update',
        'as' => 'training.file.update'
    ]);

    Route::post('/file/delete', [
        'uses' => 'API\TrainingController@delete',
        'as' => 'training.file.delete'
    ]);

    // Route::get('/file/download', [
    //     'uses' => 'API\TrainingController@download',
    //     'as' => 'training.file.download'
    // ]);
});

// File Download Route
Route::get('/training/file/download', [
    'uses' => 'API\TrainingController@download',
    'as' => 'training.file.download',
])->middleware(['training_file.maintenance']);

//Permissions
Route::group(['prefix' => 'permission', 'middleware' => ['auth:api', 'permission.maintenance']], function(){
    Route::get('/index', [
        'uses' => 'API\PermissionController@index',
        'as' => 'permission.index',
    ]);
    Route::get('/create', [
        'uses' => 'API\PermissionController@create',
        'as' => 'permission.create',
    ]);
    Route::post('/store', [
        'uses' => 'API\PermissionController@store',
        'as' => 'permission.store',
    ]);
    Route::post('/edit', [
        'uses' => 'API\PermissionController@edit',
        'as' => 'permission.edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'API\PermissionController@update',
        'as' => 'permission.update',
    ]);
    Route::post('/delete', [
        'uses' => 'API\PermissionController@delete',
        'as' => 'permission.delete',
    ]);

});

//Roles
Route::group(['prefix' => 'role', 'middleware' => ['auth:api', 'role.maintenance']], function(){
    Route::get('/index', [
        'uses' => 'API\RoleController@index',
        'as' => 'role.index',
    ]);
    Route::get('/create', [
        'uses' => 'API\RoleController@create',
        'as' => 'role.create',
    ]);
    Route::post('/store', [
        'uses' => 'API\RoleController@store',
        'as' => 'role.store',
    ]);
    Route::post('/edit', [
        'uses' => 'API\RoleController@edit',
        'as' => 'role.edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'API\RoleController@update',
        'as' => 'role.update',
    ]);
    Route::post('/delete', [
        'uses' => 'API\RoleController@delete',
        'as' => 'role.delete',
    ]);

});

// Brand Routes
Route::group(['prefix' => 'brand', 'middleware' => ['auth:api', 'brand.maintenance']], function(){
    Route::get('/index', [
        'uses' => 'API\BrandController@index',
        'as' => 'brand.index',
    ]);
    Route::get('/create', [
        'uses' => 'API\BrandController@create',
        'as' => 'brand.create',
    ]);
    Route::post('/store', [
        'uses' => 'API\BrandController@store',
        'as' => 'brand.store',
    ]);
    Route::post('/edit', [
        'uses' => 'API\BrandController@edit',
        'as' => 'brand.edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'API\BrandController@update',
        'as' => 'brand.update',
    ]);
    Route::post('/delete', [
        'uses' => 'API\BrandController@delete',
        'as' => 'brand.delete',
    ]);

});

// Product Model Routes
Route::group(['prefix' => 'product_model', 'middleware' => ['auth:api', 'product_model.maintenance']], function(){
    Route::post('/index', [
        'uses' => 'API\ProductModelController@index',
        'as' => 'product_model.index',
    ]);
    Route::get('/create', [
        'uses' => 'API\ProductModelController@create',
        'as' => 'product_model.create',
    ]);
    Route::post('/store', [
        'uses' => 'API\ProductModelController@store',
        'as' => 'product_model.store',
    ]);
    Route::post('/edit', [
        'uses' => 'API\ProductModelController@edit',
        'as' => 'product_model.edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'API\ProductModelController@update',
        'as' => 'product_model.update',
    ]);
    Route::post('/delete', [
        'uses' => 'API\ProductModelController@delete',
        'as' => 'product_model.delete',
    ]);

});

// Product Category Routes
Route::group(['prefix' => 'product_category', 'middleware' => ['auth:api', 'product_category.maintenance']], function(){
    Route::get('/index', [
        'uses' => 'API\ProductCategoryController@index',
        'as' => 'product_category.index',
    ]);
    Route::get('/create', [
        'uses' => 'API\ProductCategoryController@create',
        'as' => 'product_category.create',
    ]);
    Route::post('/store', [
        'uses' => 'API\ProductCategoryController@store',
        'as' => 'product_category.store',
    ]);
    Route::post('/edit', [
        'uses' => 'API\ProductCategoryController@edit',
        'as' => 'product_category.edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'API\ProductCategoryController@update',
        'as' => 'product_category.update',
    ]);
    Route::post('/delete', [
        'uses' => 'API\ProductCategoryController@delete',
        'as' => 'product_category.delete',
    ]);

});

// Expense Particular Routes
Route::group(['prefix' => 'expense_particular', 'middleware' => ['auth:api', 'expense_particular.maintenance']], function(){
    Route::get('/index', [
        'uses' => 'API\ExpenseParticularController@index',
        'as' => 'expense_particular.index',
    ]);
    Route::get('/create', [
        'uses' => 'API\ExpenseParticularController@create',
        'as' => 'expense_particular.create',
    ]);
    Route::post('/store', [
        'uses' => 'API\ExpenseParticularController@store',
        'as' => 'expense_particular.store',
    ]);
    Route::post('/edit', [
        'uses' => 'API\ExpenseParticularController@edit',
        'as' => 'expense_particular.edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'API\ExpenseParticularController@update',
        'as' => 'expense_particular.update',
    ]);
    Route::post('/delete', [
        'uses' => 'API\ExpenseParticularController@delete',
        'as' => 'expense_particular.delete',
    ]);

});

// Tactical Requisition Routes
Route::group(['prefix' => 'tactical_requisition', 'middleware' => ['auth:api', 'tactical_requisition.maintenance']], function(){
    Route::get('/index', [
        'uses' => 'API\TacticalRequisitionController@index',
        'as' => 'tactical_requisition.index',
    ]);
    Route::get('/create', [
        'uses' => 'API\TacticalRequisitionController@create',
        'as' => 'tactical_requisition.create',
    ]);
    Route::post('/store', [
        'uses' => 'API\TacticalRequisitionController@store',
        'as' => 'tactical_requisition.store',
    ]);
    Route::post('/edit', [
        'uses' => 'API\TacticalRequisitionController@edit',
        'as' => 'tactical_requisition.edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'API\TacticalRequisitionController@update',
        'as' => 'tactical_requisition.update',
    ]);
    Route::post('/delete', [
        'uses' => 'API\TacticalRequisitionController@delete',
        'as' => 'tactical_requisition.delete',
    ]);

});

// Branch Routes
Route::group(['prefix' => 'branch', 'middleware' => ['auth:api', 'branch.maintenance']], function(){
    Route::get('/index', [
        'uses' => 'API\BranchController@index',
        'as' => 'branch.index',
    ]);
    Route::get('/create', [
        'uses' => 'API\BranchController@create',
        'as' => 'branch.create',
    ]);
    Route::post('/store', [
        'uses' => 'API\BranchController@store',
        'as' => 'branch.store',
    ]);
    Route::post('/edit', [
        'uses' => 'API\BranchController@edit',
        'as' => 'branch.edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'API\BranchController@update',
        'as' => 'branch.update',
    ]);
    Route::post('/delete', [
        'uses' => 'API\BranchController@delete',
        'as' => 'branch.delete',
    ]);

});

// Company Routes
Route::group(['prefix' => 'company', 'middleware' => ['auth:api', 'company.maintenance']], function(){
    Route::get('/index', [
        'uses' => 'API\CompanyController@index',
        'as' => 'company.index',
    ]);
    Route::get('/create', [
        'uses' => 'API\CompanyController@create',
        'as' => 'company.create',
    ]);
    Route::post('/store', [
        'uses' => 'API\CompanyController@store',
        'as' => 'company.store',
    ]);
    Route::post('/edit', [
        'uses' => 'API\CompanyController@edit',
        'as' => 'company.edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'API\CompanyController@update',
        'as' => 'company.update',
    ]);
    Route::post('/delete', [
        'uses' => 'API\CompanyController@delete',
        'as' => 'company.delete',
    ]);

});

// Position Routes
Route::group(['prefix' => 'position', 'middleware' => ['auth:api', 'position.maintenance']], function(){
    Route::get('/index', [
        'uses' => 'API\PositionController@index',
        'as' => 'position.index',
    ]);
    Route::get('/create', [
        'uses' => 'API\PositionController@create',
        'as' => 'position.create',
    ]);
    Route::post('/store', [
        'uses' => 'API\PositionController@store',
        'as' => 'position.store',
    ]);
    Route::post('/edit', [
        'uses' => 'API\PositionController@edit',
        'as' => 'position.edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'API\PositionController@update',
        'as' => 'position.update',
    ]);
    Route::post('/delete', [
        'uses' => 'API\PositionController@delete',
        'as' => 'position.delete',
    ]);

});

// Department Routes
Route::group(['prefix' => 'department', 'middleware' => ['auth:api', 'department.maintenance']], function(){
    Route::get('/index', [
        'uses' => 'API\DepartmentController@index',
        'as' => 'department.index',
    ]);
    Route::get('/create', [
        'uses' => 'API\DepartmentController@create',
        'as' => 'department.create',
    ]);
    Route::post('/store', [
        'uses' => 'API\DepartmentController@store',
        'as' => 'department.store',
    ]);
    Route::post('/edit', [
        'uses' => 'API\DepartmentController@edit',
        'as' => 'department.edit',
    ]);
    Route::post('/update/{id}', [
        'uses' => 'API\DepartmentController@update',
        'as' => 'department.update',
    ]);
    Route::post('/delete', [
        'uses' => 'API\DepartmentController@delete',
        'as' => 'department.delete',
    ]);

});

//Activity Logs
Route::group(['prefix' => 'activity_logs', 'middleware' => ['auth:api', 'activity.logs']], function(){
    Route::get('/index', [
        'uses' => 'API\ActivityLogController@activity_logs',
        'as' => 'activity_logs.index',
    ]);
    
});
