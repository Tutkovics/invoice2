<?php

Route::get('/', function(){ return view('welcome'); })->name('home');

//Route::get('login', 'UserController@getLogin')->name('getLogin');
Route::get('login', 'UserController@getLogin')->name('login');
Route::post('login', 'UserController@postLogin')->name('postLogin');
//sch login
Route::get('auth', 'UserController@redirect')->name('auth');
Route::get('auth/callback', 'UserController@callback')->name('auth.callback');

Route::post('signUp', 'UserController@postSignUp')->name('postSignUp');
Route::get('logout', 'UserController@getLogout')->name('logout');

//d3
Route::get('d3/{id}', 'BillController@showGraphs')->name('d3');
Route::get('test', 'TransactionController@test')->name('test');

// for loged in users
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', 'UserController@getDashboard')->name('dashboard');
    Route::get('my_bills', 'BillController@showMyBills')->name('myBills');
    Route::get('bill/{id}', 'BillController@getBillData')->name('getBill')->where('id', '[0-9]+');
    Route::get('bill/{id}/income', 'BillController@getNewIncome')->name('newIncome')->where('id', '[0-9]+');
    Route::post('bill/{id}/income', 'BillController@postNewIncome')->name('postIncome')->where('id', '[0-9]+');
    Route::get('bill/{id}/spend', 'BillController@getNewSpend')->name('newSpend')->where('id', '[0-9]+');
    Route::post('bill/{id}/spend', 'BillController@postNewSpend')->name('postSpend')->where('id', '[0-9]+');
    Route::get('bill/{bill}/kill', 'BillController@deleteBill')->name('deleteBill')->where('bill', '[0-9]+');
    Route::get('addNewBill', 'BillController@getNewBill')->name('newBillForm');
    Route::post('addNewBill', 'BillController@postNewBill')->name('postNewBill');
    Route::get('profile', 'UserController@getShowUser')->name('showUser');//->where('id', '[0-9]+');
    Route::post('profile', 'UserController@postUpdateUser')->name('updateUserData');//->where('id', '[0-9]+');
    Route::get('transaction/{transaction}', 'TransactionController@showTransaction')->name('showTransaction')->where('transaction', '[0-9]+');
    Route::post('transaction/{transaction}', 'TransactionController@editTransaction')->name('editTransaction')->where('transaction', '[0-9]+');
    Route::get('transaction/{transaction}/kill', 'TransactionController@deleteTransaction')->name('deleteTransaction')->where('transaction', '[0-9]+');

    Route::post('picture/new', 'UserController@uploadProfilePicture')->name('uploadProfilePicture');
    Route::get('picture/show', 'UserController@showProfilePicture')->name('picture.show');

});


