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
Route::redirect('/', '/login');
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

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

    // Book Appointment
    Route::delete('bookappointments/destroy', 'BookAppointmentController@massDestroy')->name('bookappointments.massDestroy');
    Route::post('bookappointments/media', 'BookAppointmentController@storeMedia')->name('bookappointments.storeMedia');
    Route::resource('bookappointments', 'BookAppointmentController');

    // Tamhub
    Route::delete('tamhubs/destroy', 'TamHubController@massDestroy')->name('tamhubs.massDestroy');
    Route::post('tamhubs/media', 'TamHubController@storeMedia')->name('tamhubs.storeMedia');
    Route::resource('tamhubs', 'TamHubController');

     //Library 
     Route::delete('librarys/destroy', 'LibraryController@massDestroy')->name('librarys.massDestroy');
     Route::post('librarys/media', 'LibraryController@storeMedia')->name('librarys.storeMedia');
     Route::resource('librarys', 'LibraryController');
    
     
    // Resource Category
    Route::delete('librarycategorys/destroy', 'LibraryCategoryController@massDestroy')->name('librarycategorys.massDestroy');
    Route::post('librarycategorys/media', 'LibraryCategoryController@storeMedia')->name('librarycategorys.storeMedia');
    Route::resource('librarycategorys', 'LibraryCategoryController');
    
    // Resource Category
    Route::delete('resourcecategorys/destroy', 'ResourceCategoryController@massDestroy')->name('resourcecategorys.massDestroy');
    Route::post('resourcecategorys/media', 'ResourceCategoryController@storeMedia')->name('resourcecategorys.storeMedia');
    Route::resource('resourcecategorys', 'ResourceCategoryController');

    //Category 
    Route::delete('categorys/destroy', 'CategoryController@massDestroy')->name('categorys.massDestroy');
    Route::post('categorys/media', 'CategoryController@storeMedia')->name('categorys.storeMedia');
    Route::resource('categorys', 'CategoryController');

    // Counselor 
    Route::delete('counselors/destroy', 'CounselorController@massDestroy')->name('counselors.massDestroy');
    Route::resource('counselors', 'CounselorController');
    Route::get('mychat/{id}', 'CounselorController@mychat')->name('counselors.mychat');
    Route::get('counselor-availability/{status}', 'CounselorController@counselorAvailability');
    Route::get('mychatAdmin', 'CounselorController@mychatAdmin')->name('counselors.mychatAdmin');

     // Counselor Assignments
     Route::delete('counselorassignments/destroy', 'CounselorAssignmentController@massDestroy')->name('counselorassignments.massDestroy');
     Route::resource('counselorassignments', 'CounselorAssignmentController');
     Route::get('counselor-assignment/{counselorId}/{userId}', 'CounselorAssignmentController@counselorAssignUser');


    // Counselor Current cases
    Route::delete('counselorcurrentcases/destroy', 'CounselorCurrentCasesController@massDestroy')->name('counselor_current_cases.massDestroy');
    Route::resource('counselorcurrentcases', 'CounselorCurrentCasesController');
    Route::get('counselor-current-cases', 'CounselorCurrentCasesController@currentCounselor')->name('counselor-current-cases.currentCounselor');
    Route::get('counselor-assign-user/{userId}', 'CounselorCurrentCasesController@counselorAssignUser')->name('counselor-assign-user.counselorAssignUser');
    Route::get('user-assign-admin/{userId}', 'CounselorCurrentCasesController@userAssignAdmin')->name('user-assign-admin.userAssignAdmin');

    Route::get('close-chat/{userId}', 'CounselorCurrentCasesController@closeChat')->name('chat-closed.closeChat');

    //counselor and user chat
    Route::get('counselor-assign-user-chat/{userId}/{categoryId}', 'CounselorCurrentCasesController@counselorUserChat')->name('counselor-assign-user-chat.counselorUserChat');

    Route::post('counselor-chat', 'CounselorCurrentCasesController@chat')->name('counselor-chat.chat');

    Route::get('counselor-chat-update-chat/{userId}', 'CounselorCurrentCasesController@update_chat_ajax')->name('counselor-chat-update-chat.update_chat_ajax');


    //Live chat 
    Route::get('counselor-live-chat/{userId}', 'CounselorCurrentCasesController@counselorLiveChat')->name('counselor-live-chat.counselorLiveChat');


    // Counselor Past Cases
    Route::delete('counselor-past-cases/destroy', 'CounselorPastCasesController@massDestroy')->name('counselor-past-cases.massDestroy');
    Route::get('past-chat-history/{userId}', 'CounselorPastCasesController@show')->name('past-chat-history.show');
    Route::resource('counselor-past-cases', 'CounselorPastCasesController');

   
    //privacy policy
    Route::delete('privacypolicys/destroy', 'PrivacyPolicyController@massDestroy')->name('privacypolicys.massDestroy');
    Route::post('privacypolicys/media', 'PrivacyPolicyController@storeMedia')->name('privacypolicys.storeMedia');
    Route::resource('privacypolicys', 'PrivacyPolicyController');

     // push notification 
     Route::get('/push-notificaiton', 'NotificationController@index')->name('push-notificaiton');
     Route::post('/store-token', 'NotificationController@storeToken')->name('store.token');
     Route::post('/send-notification', 'NotificationController@sendNotification')->name('send.notification');

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

