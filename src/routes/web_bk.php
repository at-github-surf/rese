<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/detail', function () {
    return view('detail');
});

Route::get('/thanks', function () {
    return view('thanks');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/done', function () {
    return view('done');
});

Route::get('/mypage', function () {
    return view('mypage');
});

Route::get('/change', function () {
    return view('change');
});

Route::get('/changedone', function () {
    return view('changedone');
});

Route::get('/detail/evaluation', function () {
    return view('evaluation');
});


Route::get('/siteadmin', function () {
    return view('siteadmin/index');
});

Route::get('/siteadmin/addmanager', function () {
    return view('siteadmin/addmanager');
});


Route::get('/storemanage', function () {
    return view('storemanage/index');
});