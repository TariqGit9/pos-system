<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('landing');
})->middleware('guest');

Route::get('/company-suspended', function () {
    return view('company-suspended');
})->name('company.suspended');

Auth::routes(['register' => false]);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')
        ->name('home');

    Route::get('/sales-purchases/chart-data', 'HomeController@salesPurchasesChart')
        ->name('sales-purchases.chart');

    Route::get('/current-month/chart-data', 'HomeController@currentMonthChart')
        ->name('current-month.chart');

    Route::get('/payment-flow/chart-data', 'HomeController@paymentChart')
        ->name('payment-flow.chart');

    // Company management (Super Admin only)
    Route::group(['middleware' => 'super_admin'], function () {
        Route::post('/companies/leave', 'CompanyController@leave')->name('companies.leave');
        Route::post('/companies/{company}/enter', 'CompanyController@enter')->name('companies.enter');
        Route::resource('companies', 'CompanyController');
    });
});

