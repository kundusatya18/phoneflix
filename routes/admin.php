<?php

Route::group(['prefix' => 'admin'], function () {

    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
	Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');
	
	//admin password reset routes
    Route::post('/password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset','Admin\ResetPasswordController@reset');
    Route::get('/password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

	Route::get('/register', 'Admin\RegisterController@showRegistrationForm')->name('admin.register')->middleware('hasInvitation');
	Route::post('/register', 'Admin\RegisterController@register')->name('admin.register.post');

    Route::group(['middleware' => ['auth:admin']], function () {
        
        Route::get('/', 'Admin\LoginController@index')->name('admin.dashboard');

		Route::get('/invite_list', 'Admin\InvitationController@index')->name('admin.invite');
	    Route::get('/invitation', 'Admin\InvitationController@create')->name('admin.invite.create');
		Route::post('/invitation', 'Admin\InvitationController@store')->name('admin.invitation.store');
		Route::get('/adminuser', 'Admin\AdminUserController@index')->name('admin.adminuser');
		Route::post('/adminuser', 'Admin\AdminUserController@updateAdminUser')->name('admin.adminuser.update');
	    Route::get('/settings', 'Admin\SettingController@index')->name('admin.settings');
		Route::post('/settings', 'Admin\SettingController@update')->name('admin.settings.update');
		
		Route::get('/profile', 'Admin\ProfileController@index')->name('admin.profile');
		Route::post('/profile', 'Admin\ProfileController@update')->name('admin.profile.update');
		Route::post('/changepassword', 'Admin\ProfileController@changePassword')->name('admin.profile.changepassword');

		Route::group(['prefix'  =>   'categories'], function() {
			Route::get('/', 'Admin\CategoryController@index')->name('admin.categories.index');
			Route::get('/create', 'Admin\CategoryController@create')->name('admin.categories.create');
			Route::post('/store', 'Admin\CategoryController@store')->name('admin.categories.store');
			Route::get('/{id}/edit', 'Admin\CategoryController@edit')->name('admin.categories.edit');
			Route::post('/update', 'Admin\CategoryController@update')->name('admin.categories.update');
			Route::get('/{id}/delete', 'Admin\CategoryController@delete')->name('admin.categories.delete');
			Route::post('updateStatus', 'Admin\CategoryController@updateStatus')->name('admin.categories.updateStatus');
		});
		Route::group(['prefix'  =>   'genres'], function() {
			Route::get('/', 'Admin\GenreController@index')->name('admin.genres.index');
			Route::get('/create', 'Admin\GenreController@create')->name('admin.genres.create');
			Route::post('/store', 'Admin\GenreController@store')->name('admin.genres.store');
			Route::get('/{id}/edit', 'Admin\GenreController@edit')->name('admin.genres.edit');
			Route::post('/update', 'Admin\GenreController@update')->name('admin.genres.update');
			Route::get('/{id}/delete', 'Admin\GenreController@delete')->name('admin.genres.delete');
			Route::post('updateStatus', 'Admin\GenreController@updateStatus')->name('admin.genres.updateStatus');
		});
		Route::group(['prefix'  =>   'banner'], function() {
			Route::get('/', 'Admin\BannerController@index')->name('admin.banner.index');
			Route::get('/create', 'Admin\BannerController@create')->name('admin.banner.create');
			Route::post('/store', 'Admin\BannerController@store')->name('admin.banner.store');
			Route::get('/{id}/edit', 'Admin\BannerController@edit')->name('admin.banner.edit');
			Route::post('/update', 'Admin\BannerController@update')->name('admin.banner.update');
			Route::get('/{id}/delete', 'Admin\BannerController@delete')->name('admin.banner.delete');
			Route::post('updateStatus', 'Admin\BannerController@updateStatus')->name('admin.banner.updateStatus');
		});
		Route::group(['prefix'  =>   'trailer'], function() {
			Route::get('/', 'Admin\TrailerController@index')->name('admin.trailer.index');
			Route::get('/create', 'Admin\TrailerController@create')->name('admin.trailer.create');
			Route::post('/store', 'Admin\TrailerController@store')->name('admin.trailer.store');
			Route::get('/{id}/edit', 'Admin\TrailerController@edit')->name('admin.trailer.edit');
			Route::post('/update', 'Admin\TrailerController@update')->name('admin.trailer.update');
			Route::get('/{id}/delete', 'Admin\TrailerController@delete')->name('admin.trailer.delete');
			Route::post('updateStatus', 'Admin\TrailerController@updateStatus')->name('admin.trailer.updateStatus');
		});
		Route::group(['prefix'  => 'language'], function() {
			Route::get('/', 'Admin\LanguageController@index')->name('admin.language.index');
			Route::get('/create', 'Admin\LanguageController@create')->name('admin.language.create');
			Route::post('/store', 'Admin\LanguageController@store')->name('admin.language.store');
			Route::get('/{id}/edit', 'Admin\LanguageController@edit')->name('admin.language.edit');
			Route::post('/update', 'Admin\LanguageController@update')->name('admin.language.update');
			Route::get('/{id}/delete', 'Admin\LanguageController@delete')->name('admin.language.delete');
			Route::post('updateStatus', 'Admin\LanguageController@updateStatus')->name('admin.language.updateStatus');
		});
		Route::group(['prefix'  =>   'show'], function() {
			Route::get('/', 'Admin\ShowController@index')->name('admin.show.index');
			Route::get('/create', 'Admin\ShowController@create')->name('admin.show.create');
			Route::post('/store', 'Admin\ShowController@store')->name('admin.show.store');
			Route::get('/{id}/edit', 'Admin\ShowController@edit')->name('admin.show.edit');
			Route::post('/update', 'Admin\ShowController@update')->name('admin.show.update');
			Route::get('/{id}/delete', 'Admin\ShowController@delete')->name('admin.show.delete');
			Route::post('updateStatus', 'Admin\ShowController@updateStatus')->name('admin.show.updateStatus');
			Route::get('/pay-per-click-subscriptions', 'Admin\ShowController@getPayPerClickSubscriptions')->name('admin.show.getPayPerClickSubscriptions');
			Route::get('/transaction-list', 'Admin\ShowController@getTransactionsData')->name('admin.show.getTransactionsData');
		});

		Route::group(['prefix'  =>   'webseries'], function() {
			Route::get('/', 'Admin\WebseriesController@index')->name('admin.webseries.index');
			Route::get('/create', 'Admin\WebseriesController@create')->name('admin.webseries.create');
			Route::post('/store', 'Admin\WebseriesController@store')->name('admin.webseries.store');
			Route::get('/{id}/edit', 'Admin\WebseriesController@edit')->name('admin.webseries.edit');
			Route::post('/update', 'Admin\WebseriesController@update')->name('admin.webseries.update');
			Route::get('/{id}/delete', 'Admin\WebseriesController@delete')->name('admin.webseries.delete');
			Route::post('updateStatus', 'Admin\WebseriesController@updateStatus')->name('admin.webseries.updateStatus');
			Route::get('/pay-per-click-subscriptions', 'Admin\WebseriesController@getPayPerClickSubscriptions')->name('admin.webseries.getPayPerClickSubscriptions');
			Route::get('/transaction-list', 'Admin\WebseriesController@getTransactionsData')->name('admin.webseries.getTransactionsData');
		});

		Route::group(['prefix'  =>   'episode'], function() {
			Route::get('/', 'Admin\EpisodeController@index')->name('admin.episode.index');
			Route::get('/create', 'Admin\EpisodeController@create')->name('admin.episode.create');
			Route::post('/store', 'Admin\EpisodeController@store')->name('admin.episode.store');
			Route::get('/{id}/edit', 'Admin\EpisodeController@edit')->name('admin.episode.edit');
			Route::post('/update', 'Admin\EpisodeController@update')->name('admin.episode.update');
			Route::get('/{id}/delete', 'Admin\EpisodeController@delete')->name('admin.episode.delete');
			Route::post('updateStatus', 'Admin\EpisodeController@updateStatus')->name('admin.episode.updateStatus');
			Route::get('/pay-per-click-subscriptions', 'Admin\EpisodeController@getPayPerClickSubscriptions')->name('admin.episode.getPayPerClickSubscriptions');
			Route::get('/transaction-list', 'Admin\EpisodeController@getTransactionsData')->name('admin.episode.getTransactionsData');
		});

		Route::group(['prefix'  =>   'users'], function() {
			Route::get('/', 'Admin\UserManagementController@index')->name('admin.users.index');
			Route::get('/create', 'Admin\UserManagementController@create')->name('admin.users.create');
			Route::post('/store', 'Admin\UserManagementController@store')->name('admin.users.store');
			Route::get('/{id}/edit', 'Admin\UserManagementController@edit')->name('admin.users.edit');
			Route::post('/update', 'Admin\UserManagementController@update')->name('admin.users.update');
			Route::post('/', 'Admin\UserManagementController@updateUser')->name('admin.users.post');
			Route::get('/{id}/delete', 'Admin\UserManagementController@delete')->name('admin.users.delete');
			Route::get('/{id}/view', 'Admin\UserManagementController@viewDetail')->name('admin.users.detail');
			Route::post('updateStatus', 'Admin\UserManagementController@updateStatus')->name('admin.users.updateStatus');
		});
		
		Route::group(['prefix'  =>   'packages'], function() {
			Route::get('/', 'Admin\PackageController@index')->name('admin.packages.index');
			Route::get('/create', 'Admin\PackageController@create')->name('admin.packages.create');
			Route::post('/store', 'Admin\PackageController@store')->name('admin.packages.store');
			Route::get('/{id}/edit', 'Admin\PackageController@edit')->name('admin.packages.edit');
			Route::post('/update', 'Admin\PackageController@update')->name('admin.packages.update');
			Route::get('/{id}/delete', 'Admin\PackageController@delete')->name('admin.packages.delete');
			Route::post('/updateStatus', 'Admin\PackageController@updateStatus')->name('admin.packages.updateStatus');
			Route::get('/all-subscriptions', 'Admin\PackageController@getSubscriptions')->name('admin.packages.getSubscriptions');
		});
		
	});

});
?>