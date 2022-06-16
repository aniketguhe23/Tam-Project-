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
  
    // Counselor Past Cases
    Route::delete('counselor-past-cases/destroy', 'CounselorPastCasesController@massDestroy')->name('counselor-past-cases.massDestroy');
    Route::resource('counselor-past-cases', 'CounselorPastCasesController');

   
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
