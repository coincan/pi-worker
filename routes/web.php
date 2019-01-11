<?php

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
    return view('welcome');
});


Route::get('/job', function () {
    for ($i = 0; $i < 5; $i++) {
        \App\Jobs\EchoJob::dispatch();
    }

    return '5 Jobs dispatched!';
});