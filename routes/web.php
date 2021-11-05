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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/get-data', [App\Http\Controllers\CustomerController::class, 'testing']);
//random customer data create
Route::get('/create-data', [App\Http\Controllers\CustomerController::class, 'create_data']);
Route::get('/view-customer-data', [App\Http\Controllers\CustomerController::class, 'view_customer_data']);

Route::get('/get-test-data', [App\Http\Controllers\CustomerController::class, 'getCus']);

Route::post('post-year-month', [App\Http\Controllers\CustomerController::class, 'post_year_month']);

//check redis cache --> test function
Route::get('cached-redis-data', [App\Http\Controllers\HomeController::class, 'cached_redis_data']);

Route::get('view-redis-data', [App\Http\Controllers\HomeController::class, 'view_redis_data']);

//check redis cache work or not

Route::get('get-redis-test-data', [App\Http\Controllers\CustomerController::class, 'get_redis_test_data']);


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    echo "Cleared All cached";
});

Route::get('save-people-data', [App\Http\Controllers\PeopleController::class, 'create']);


Route::get('view-people-data', [App\Http\Controllers\PeopleController::class, 'view_people_data']);

Route::get('store-redis-data', [App\Http\Controllers\PeopleController::class, 'store_redis_data']);