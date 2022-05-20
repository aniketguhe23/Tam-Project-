<?php

Route::redirect('/', '/login');
Route::get('clear-cache', function() {
    Artisan::call('cache:clear');
    echo "success";
});
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Customers
    Route::delete('customers/destroy', 'CustomersController@massDestroy')->name('customers.massDestroy');
    Route::resource('customers', 'CustomersController');

    // Karigars
    Route::delete('karigars/destroy', 'KarigarController@massDestroy')->name('karigars.massDestroy');
    Route::resource('karigars', 'KarigarController');

    // Product Categories
    Route::delete('product-categories/destroy', 'ProductCategoryController@massDestroy')->name('product-categories.massDestroy');
    Route::post('product-categories/media', 'ProductCategoryController@storeMedia')->name('product-categories.storeMedia');
    Route::post('product-categories/ckmedia', 'ProductCategoryController@storeCKEditorImages')->name('product-categories.storeCKEditorImages');
    Route::resource('product-categories', 'ProductCategoryController');

    // Products
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::resource('products', 'ProductController');

    // Design Numbers
    Route::delete('design-numbers/destroy', 'DesignNumberController@massDestroy')->name('design-numbers.massDestroy');
    Route::post('design-numbers/media', 'DesignNumberController@storeMedia')->name('design-numbers.storeMedia');
    Route::post('design-numbers/ckmedia', 'DesignNumberController@storeCKEditorImages')->name('design-numbers.storeCKEditorImages');
    Route::resource('design-numbers', 'DesignNumberController');

    Route::get('design-share-show', 'DesignNumberController@desing_share_show');
    Route::get('design-share-create', 'DesignNumberController@desing_share_create');
    Route::post('design-share-store', 'DesignNumberController@desing_share_store');
    Route::get('design-share-data', 'DesignNumberController@desing_share_data');
    Route::get('design-share-edit/{id}', 'DesignNumberController@desing_share_edit');
    Route::post('design-share-update', 'DesignNumberController@desing_share_update');
    Route::get('design-share-delete/{id}', 'DesignNumberController@desing_share_delete');

    // Customer Orders
    Route::delete('customer-orders/destroy', 'CustomerOrdersController@massDestroy')->name('customer-orders.massDestroy');
    Route::resource('customer-orders', 'CustomerOrdersController');

    // Karigar Orders
    Route::delete('karigar-orders/destroy', 'KarigarOrdersController@massDestroy')->name('karigar-orders.massDestroy');
    Route::resource('karigar-orders', 'KarigarOrdersController');

    // Task Statuses
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tags
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Tasks
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendars
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
