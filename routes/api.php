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

     //Library 
     Route::apiResource('librarycategorys', 'LibraryCategoryApiController');

    //Library 
    Route::apiResource('counselorassignments', 'CounselorAssignmentApiController');


});

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin'], function () {

    // //customer routes
    // Route::get('users', 'UsersApiController@index');
    Route::post('customers-store', 'CustomersApiController@store');

});


