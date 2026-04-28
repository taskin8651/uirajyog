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

    // Hero Sections
     Route::resource('hero-sections', HeroSectionController::class);

    Route::delete('hero-sections/{heroSection}/image', [HeroSectionController::class, 'destroyImage'])
        ->name('hero-sections.image.destroy');

        // brands
        Route::resource('brands', BrandController::class);

Route::delete('brands/{brand}/logo', [BrandController::class, 'destroyLogo'])
    ->name('brands.logo.destroy');

    // enquiries
    Route::resource('enquiries', EnquiryController::class);

Route::post('enquiries/{enquiry}/mark-as-read', [EnquiryController::class, 'markAsRead'])
    ->name('enquiries.mark-as-read');

Route::post('enquiries/{enquiry}/mark-as-unread', [EnquiryController::class, 'markAsUnread'])
    ->name('enquiries.mark-as-unread');

Route::post('enquiries/{enquiry}/update-status', [EnquiryController::class, 'updateStatus'])
    ->name('enquiries.update-status');

    // manufacture sections
    Route::resource('manufacture-sections', ManufactureSectionController::class);

Route::delete('manufacture-sections/{manufactureSection}/image', [ManufactureSectionController::class, 'destroyImage'])
    ->name('manufacture-sections.image.destroy');

    // FAQ
     Route::resource('faqs', FaqController::class);

     // Certificates
     Route::resource('certificates', CertificateController::class);

Route::delete('certificates/{certificate}/pdf', [CertificateController::class, 'destroyPdf'])
    ->name('certificates.pdf.destroy');


    // About Sections
Route::resource('about-sections', AboutSectionController::class);

Route::delete('about-sections/{aboutSection}/image', [AboutSectionController::class, 'destroyImage'])
    ->name('about-sections.image.destroy');

    // Our Story Sections
    Route::resource('our-story-sections', OurStorySectionController::class);

Route::delete('our-story-sections/{ourStorySection}/image', [OurStorySectionController::class, 'destroyImage'])
    ->name('our-story-sections.image.destroy');

    // Site Settings
    Route::get('site-settings', [App\Http\Controllers\Admin\SiteSettingController::class, 'index'])
    ->name('site-settings.index');

Route::put('site-settings/{siteSetting}', [App\Http\Controllers\Admin\SiteSettingController::class, 'update'])
    ->name('site-settings.update');

Route::delete('site-settings/{siteSetting}/logo', [App\Http\Controllers\Admin\SiteSettingController::class, 'destroyLogo'])
    ->name('site-settings.logo.destroy');

Route::delete('site-settings/{siteSetting}/footer-logo', [App\Http\Controllers\Admin\SiteSettingController::class, 'destroyFooterLogo'])
    ->name('site-settings.footer-logo.destroy');

Route::delete('site-settings/{siteSetting}/favicon', [App\Http\Controllers\Admin\SiteSettingController::class, 'destroyFavicon'])
    ->name('site-settings.favicon.destroy');
    
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


// Frontend Routes

Route::get('/', [App\Http\Controllers\Custom\HomeController::class, 'index'])->name('home');

Route::get('/products', [App\Http\Controllers\Custom\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [App\Http\Controllers\Custom\ProductController::class, 'show'])->name('products.show');

Route::get('/about', [App\Http\Controllers\Custom\AboutController::class, 'index'])->name('about');

Route::get('/certificates', [App\Http\Controllers\Custom\CertificateController::class, 'index'])->name('certificates.index');

Route::get('/enquiry', [App\Http\Controllers\Custom\EnquiryController::class, 'index'])
    ->name('custom.enquiry');

Route::post('/enquiry-submit', [App\Http\Controllers\Custom\EnquiryController::class, 'store'])
    ->name('custom.enquiry.submit');

Route::get('/manufacturing', [App\Http\Controllers\Custom\ManufacturingController::class, 'index'])
    ->name('custom.manufacturing');
