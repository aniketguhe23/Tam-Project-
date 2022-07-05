<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    //Tamhub
    Route::apiResource('tamhubs', 'TamhubApiController');
    
    //Tamhub Resource Category
    Route::apiResource('resourcecategorys', 'ResourceCategoryApiController');

   //Library 
    Route::apiResource('librarys', 'LibraryApiController');

    //Library Categorys
     Route::apiResource('librarycategorys', 'LibraryCategoryApiController');

   //Counselor Assignments
    Route::apiResource('counselorassignments', 'CounselorAssignmentApiController');

    //Counselor Categorys
    Route::apiResource('counselorcategorys', 'CounselorCategoryApiController');

    //State 
    Route::apiResource('states', 'StateApiController');

    //Profile details
    Route::get('users-profiles', 'UserAuthApiController@profile');

    //Profile update
    Route::post('users-profiles-update', 'UserAuthApiController@editProfile');

    //Profile update
     Route::post('state-by-resource-category', 'TamhubApiController@stateResourceCategorys');

    //Profile update
     Route::post('privacy-policy', 'PrivacyPolicyApiController@privacyPolicy');

    //Asnyc
    Route::post('counselor-async-user', 'CounselorAssignmentApiController@async');

    //Asnyc
    Route::post('async-get-chats', 'CounselorAssignmentApiController@getChat');

    //Api push notification 
    Route::get('/push-notificaiton', 'NotificationApiController@index')->name('push-notificaiton');
    Route::post('/store-token', 'NotificationApiController@storeToken')->name('store.token');
    Route::post('/send-notification', 'NotificationApiController@sendNotification')->name('send.notification');

});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {

    // //customer routes
    // Route::get('users', 'UsersApiController@index');
    Route::post('customers-store', 'CustomersApiController@store');

    Route::post('/login', 'UserAuthApiController@login')->name('login.api');
    Route::post('/register','UserAuthApiController@register')->name('register.api');
    Route::post('/logout', 'UserAuthApiController@logout')->name('logout.api');

});




