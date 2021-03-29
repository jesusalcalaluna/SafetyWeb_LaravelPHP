<?php

use App\Http\Controllers\PeopleController;
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
})->name("index");

//Diseños prueba
Route::get('/test', 'test@test')->name('test');

//-------------------------Formularios
//Condiciones
Route::get('/unsafeConditionsForm', 'UnsafeConditionsController@showWriteUnsafeConditions')->name('unsafeConditionsForm');
Route::post('/unsafeConditionsForm', 'UnsafeConditionsController@writeUnsafeConditions')->name('postUnsafeCondition');
//Cuidado
Route::get('/companionCare', 'CompanionCareController@showWriteCompanionCare')->name('companionCareForm');
Route::post('/companionCare', 'CompanionCareController@writeCompanionCare')->name('companionCare');
//-----------------------------------


Route::post('/search/{word}', 'UnsafeConditionsController@search');

Route::group(['middleware' => ['auth']], function () {
    //Dashboard
    Route::get('/dashboard','DashboardController@index')->name('dashboard');
    Route::get('/peopleTable', 'PeopleController@getPeople')->name('pepleTable');
    Route::get('/peopleTableExtern', 'PeopleController@getPeople')->name('pepleTableExtern');

    //Cuidado del compañero

    Route::get('/getCompanionCare', 'CompanionCareController@readCompanionCare')->name('getCompanionCare');

    //Condiciones Inseguras

    Route::get('/UnsafeConditions', 'UnsafeConditionsController@readUnsafeConditions')->name('getUnsafeConditions');
    Route::post('/updateUnsafeCondition', 'UnsafeConditionsController@updateUnsafeConditions')->name('updateUnsafeCondition');
    Route::get('/UnsafeConditions/{id}', 'UnsafeConditionsController@readUnsafeConditionDetails')->name('unsafeConditionDetails');
    Route::get('/UnsafeConditionsBy/{status}', 'UnsafeConditionsController@getUnsafeConditionByStatus')->name('unsafeConditionByStatus');

    //Usuarios y Personal
    Route::get('/updateperson/{id}', 'PeopleController@updatePerson')->name('updateperson');
    Route::get('/newPersonExtern', 'PeopleController@createPersonForm')->name('newPersonFormExtern');
    Route::post('/newPersonExtern', 'PeopleController@createPersonExtern')->name('newPersonExtern');
    Route::get('/newPerson', 'PeopleController@createPersonForm')->name('newPersonForm');
    Route::post('/newPerson', 'PeopleController@createPerson')->name('newPerson');

    Route::group(['middleware' => ['checkpuesto:ADMINISTRACIÓN']], function (){
        
    });
});

require __DIR__.'/auth.php';
