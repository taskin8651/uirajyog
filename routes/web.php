<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});
 
Auth::routes();

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

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Product Categories
     Route::resource('product-categories', ProductCategoryController::class);
     Route::resource('products', ProductController::class);

Route::delete('products/{product}/main-image', [ProductController::class, 'destroyMainImage'])
    ->name('products.main-image.destroy');

Route::delete('products/{product}/gallery-image/{media}', [ProductController::class, 'destroyGalleryImage'])
    ->name('products.gallery-image.destroy');

     Route::resource('hero-sections', HeroSectionController::class);

    Route::delete('hero-sections/{heroSection}/image', [HeroSectionController::class, 'destroyImage'])
        ->name('hero-sections.image.destroy');

        Route::resource('brands', BrandController::class);

Route::delete('brands/{brand}/logo', [BrandController::class, 'destroyLogo'])
    ->name('brands.logo.destroy');

    Route::resource('enquiries', EnquiryController::class);

Route::post('enquiries/{enquiry}/mark-as-read', [EnquiryController::class, 'markAsRead'])
    ->name('enquiries.mark-as-read');

Route::post('enquiries/{enquiry}/mark-as-unread', [EnquiryController::class, 'markAsUnread'])
    ->name('enquiries.mark-as-unread');

Route::post('enquiries/{enquiry}/update-status', [EnquiryController::class, 'updateStatus'])
    ->name('enquiries.update-status');
    
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

