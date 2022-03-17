<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('login', 'Auth\AuthController@login');
Route::post('register', 'Auth\AuthController@register');
Route::group(['middleware' => ['jwt.verify']], function() {
    Route::get('logout', 'Auth\AuthController@logout');

    Route::group(['middleware' => 'admin'], function(){
        Route::get('/companies','Api\CompanyController@allCompany');
        Route::get('/company/{company_id}', 'Api\CompanyController@getcompany');
        Route::post('/company/create', 'Api\CompanyController@create');
        Route::put('/company/update/{company_id}', 'Api\CompanyController@update');
        Route::delete('/company/delete/{company_id}','Api\CompanyController@delete');


    });
    Route::middleware(['company'])->group(function(){
        Route::get('/employees/{company_id}', 'Api\EmployeeController@allEmployees');
        Route::get('/employee/{employee_id}', 'Api\EmployeeController@getEmployee');
        Route::post('/employee/create', 'Api\EmployeeController@create');
        Route::put('/employee/update/{employee_id}', 'Api\EmployeeController@update');
        Route::delete('/employee/delete/{employee_id}','Api\EmployeeController@delete');
    });

});
