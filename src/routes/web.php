<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\StoreManageController;
use App\Http\Controllers\ReserveController;
use App\Http\Controllers\ReseAuthController;
use App\Http\Controllers\ReseResistController;

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

Route::get('/', [StoreController::class, 'getIndex'])->name('index');
Route::post('/', [StoreController::class, 'searchStore']);

Route::get('/detail/{store_id?}', [StoreController::class, 'getStoreDetail'])
    ->where('store_id', '^[0-9]+');

//Route::post('register', [ReseResistController::class, 'create']);
Route::post('login', [ReseAuthController::class, 'store']);


Route::middleware('auth')->group(function () {
    Route::get('/mypage',  [StoreController::class, 'getMyPage']);
    Route::get('/detail/evaluation/{store_id}',  [StoreController::class, 'viewVisitedShop']);
    Route::post('/detail/evaluation/{store_id}',  [StoreController::class, 'postEvaluation']);
    Route::get('/favorite/{store_id}', [StoreController::class, 'postFavorite']);

    Route::post('/reserve/{store_id}',  [ReserveController::class, 'postReserve']);
    Route::get('/reserve/change/{reserve_id}',  [ReserveController::class, 'editReserve']);
    Route::post('/reserve/change/{reserve_id}',  [ReserveController::class, 'changeReserve']);
    Route::get('/reserve/cancel/{reserve_id}', [ReserveController::class, 'cancelReserve']);
    Route::get('/storemanage/check/{store_id}/{reserve_id}', [ReserveController::class, 'confReserve']);
    Route::post('/storemanage/check/{store_id}/{reserve_id}', [ReserveController::class, 'checkVisit']);

    Route::get('/siteadmin',  [StoreManageController::class, 'viewAdmin'])->name('siteadmin');
    Route::get('/siteadmin/addmanager',  [StoreManageController::class, 'viewAddStoreManager']);
    Route::post('/siteadmin/addmanager',  [StoreManageController::class, 'storeStoreManager']);
    Route::get('/siteadmin/sendmail',  [StoreManageController::class, 'viewInfoMail']);
    Route::post('/siteadmin/sendmail',  [StoreManageController::class, 'sendInfoMail']);

    Route::get('/storemanage',  [StoreManageController::class, 'viewMyStore'])->name('viewMyStore');
    Route::post('/storemanage',  [StoreManageController::class, 'createStore']);
    Route::post('/storemanage/{store_id}',  [StoreManageController::class, 'editStore']);
    Route::get('/storemanage/reserve/{store_id}',  [StoreManageController::class, 'checkReserve']);
    Route::get('/storemanage/done', function(){ return view('storemanage/editstoredone'); })->name('editdone');
});

Route::get('/thanks', function () {
    return view('thanks');
});

Route::get('/done', function () {
    return view('done');
});

Route::get('/changedone', function () {
    return view('changedone');
});

Route::get('/back', function () {
    return back();
});

Route::get('/siteadmin/sended', function () {
    return view('/siteadmin/sended');
});