<?php 
Route::group(['namespace'=>'Admin'],function () {
    Route::get('asd','User\#@#')->name('#');
    Route::get('#','User\#@#')->name('#')->middleware(["check.admin.login", "role.auth"]);
    Route::get('#','User\#@#')->name('#')->middleware(["check.admin.login", "role.auth"]);
    Route::get('admin/home/default/index','Home\DefaultController@index')->name('admin.home.default.index')->middleware(["check.admin.login", "role.auth"]);
    Route::get('admin/login/index','Login\LoginController@index')->name('admin.login.index')->middleware(["check.admin.login"]);
    Route::get('admin/home/index','Home\HomeController@index')->name('admin.home.index')->middleware(["check.admin.login"]);
    Route::get('admin/develop/index','DevelopController@index')->name('admin.develop.index')->middleware(["check.admin.login", "role.auth"]);
    Route::post('admin/develop/getRouteData','DevelopController@getRouteData')->name('admin.develop.getRouteData')->middleware(["check.admin.login.ajax", "role.auth.ajax"]);
    Route::get('admin/login/logout','Login\LoginController@logout')->name('admin.login.logout');
    Route::get('admin/login/login','Login\LoginController@login')->name('admin.login.login');
});
