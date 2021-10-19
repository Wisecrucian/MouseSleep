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
    return view('welcome');
});

Auth::routes();


Route::group(['namespace' => 'Test\Admin', 'prefix' => 'test/admin'], function (){
    Route::resource('show', 'MessagesController')->names('test.admin.show');
   
});

Route::get('userindex/{id}', 'Test\Admin\MessagesController@userindex')->name('test.admin.userindex');

Route::group(['namespace' => 'Test', 'prefix' => 'test'], function (){

    Route::resource('show', 'TestController', ['except' => 'destroy'])->names('test.show');
    Route::Delete('show/{show}/destroy', 'TestController@destroy')->name('test.show.destroy');
});



Route::get('/home', 'HomeController@index')->name('home');




Route::get('/postr', function () {
    $connection = pg_connect("host=127.0.0.1 dbname=testdb user=root password=root");
if($connection) {
    echo 'connected';
} else {
    echo 'there has been an error connecting';
};
});

Route::post('ulogin', 'UloginController@login');