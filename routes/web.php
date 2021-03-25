<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StackExchangeController;
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


/* tag:
     http://127.0.0.1:8000/get/questions/api
|  withoptional: 
|    http://127.0.0.1:8000/get/questions/api/1293840000/1294444800
*/
Route::prefix('get')->group(function () {
    Route::get('questions/{tagged?}/{fromdate?}/{todate?}', function ($tagged ,$fromdate= null,$todate=null) {

        if (empty($tagged)) {
            return response()->json(['error' => 'Es necesario como mínimo el parámetro tagged'], 500);
        }else {
            $apiEx = new \App\Http\Controllers\StackExchangeController();
            return $apiEx->getQuestions($tagged,$fromdate,$todate);
        }
        
    });
});


