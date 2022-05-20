<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Customers
    Route::apiResource('customers', 'CustomersApiController');


    // Karigars
    Route::apiResource('karigars', 'KarigarApiController');

    // Product Categories
    Route::post('product-categories/media', 'ProductCategoryApiController@storeMedia')->name('product-categories.storeMedia');
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Products
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Design Numbers
    Route::post('design-numbers/media', 'DesignNumberApiController@storeMedia')->name('design-numbers.storeMedia');
    Route::apiResource('design-numbers', 'DesignNumberApiController');

    // Customer Orders
    Route::apiResource('customer-orders', 'CustomerOrdersApiController');

    // Karigar Orders
    Route::apiResource('karigar-orders', 'KarigarOrdersApiController');

    // Task Statuses
    Route::apiResource('task-statuses', 'TaskStatusApiController');

    // Task Tags
    Route::apiResource('task-tags', 'TaskTagApiController');

    // Tasks
    Route::post('tasks/media', 'TaskApiController@storeMedia')->name('tasks.storeMedia');
    Route::apiResource('tasks', 'TaskApiController');
});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {

    //customer routes
    Route::get('customers-get', 'CustomersApiController@index');
    Route::post('customers-store', 'CustomersApiController@store');
    Route::post('customers-login', 'CustomersApiController@customer_login');

    //products and category routes
    Route::get('product-category', 'ProductCategoryApiController@index');
    Route::get('product-list', 'ProductApiController@index');

    //customer orders routes
    Route::post('customer-orders', 'CustomerOrdersApiController@store');
    Route::post('customer-orders-list', 'CustomerOrdersApiController@index');

    //designs routes
    Route::get('design-list', 'DesignNumberApiController@index');
    Route::get('get-shared-design-list', 'DesignNumberApiController@get_shared_design_list');

    
    //karigor order
    Route::post('karigar-signup','KarigarOrdersApiController@karigor_signup');
    Route::post('karigar-login','KarigarOrdersApiController@karigor_login');
    Route::get('karigar-orders','KarigarOrdersApiController@index');
    Route::get('karigar-orders-single','KarigarOrdersApiController@order_single');

});


