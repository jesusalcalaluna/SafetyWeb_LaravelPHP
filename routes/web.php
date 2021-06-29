<?php

use App\Http\Controllers\PeopleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;

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

Route::get('/','LandingController@getIndex')->name("index");

//Diseños prueba
Route::get('/test', 'test@test')->name('test');


//-------------------------Formularios
//Condiciones
Route::get('/unsafeConditionsForm', 'UnsafeConditionsController@showWriteUnsafeConditions')->name('unsafeConditionsForm');
Route::post('/unsafeConditionsForm', 'UnsafeConditionsController@writeUnsafeConditions')->name('postUnsafeCondition');
//Cuidado
Route::get('/companionCare', 'CompanionCareController@showWriteCompanionCare')->name('companionCareForm');
Route::post('/companionCare', 'CompanionCareController@writeCompanionCare')->name('companionCare');
//Incidentes
Route::get('/incidentForm', 'IncidentController@getForm')->name('incidentForm');
Route::post('/setIncident', 'IncidentController@setIncidentRecord')->name('setIncident');
//-----------------------------------


Route::post('/search/{word}', 'UnsafeConditionsController@search');

Route::group(['middleware' => ['auth']], function () {

    //Dashboard
    Route::get('/dashboard','DashboardController@index')->name('dashboard');

    
    //-----------Graficas Diagramas
    Route::get('/dashboardCharts', 'DashboardController@dashboardCharts')->name('dashboardCharts');
    Route::get('/dashboardPartiChartsInternoY', 'DashboardController@dashboardPartiChartsInternoY')->name('PartiCharts');


    Route::group(['middleware' => ['auth','checkRole:SUPERVISOR']], function(){
        //Permisos para los administradores y supervisores
        //-------------------------------------------------
        //USUARIOS
        //Registro de nuevos usuarios
        Route::get('/registerUsers', [RegisteredUserController::class, 'createAdmin'])->name('registerUsers');
        Route::post('/registerUsers', [RegisteredUserController::class, 'storeAdmin']);

        //PERSONAL
        //registrar personal
        Route::get('/newPerson', 'PeopleController@createPersonForm')->name('newPersonForm');
        Route::post('/newPerson', 'PeopleController@createPerson')->name('newPerson');
        //Tablas de personal
        Route::get('/peopleTable', 'PeopleController@getPeople')->name('pepleTable');
        Route::get('/peopleTableExtern', 'PeopleController@getPeopleExtern')->name('pepleTableExtern');
        Route::get('/peopleTableIntern', 'PeopleController@getPeopleIntern')->name('pepleTableIntern');
        //Actualizar Personal
        Route::get('/updateperson/{id}', 'PeopleController@updatePersonForm')->name('updateperson');
        Route::post('/updateperson', 'PeopleController@updatePerson')->name('updateper');
        //Desactivar Personal
        Route::post('/deactivatePerson', 'PeopleController@deactivatePerson')->name('deactivatePerson');

        //REPORTES
        //Condiciones Inseguras
        Route::get('/UnsafeConditions', 'UnsafeConditionsController@readUnsafeConditions')->name('getUnsafeConditions');
        Route::post('/updateUnsafeCondition', 'UnsafeConditionsController@updateUnsafeConditions')->name('updateUnsafeCondition');
        Route::get('/UnsafeConditions/{id}', 'UnsafeConditionsController@readUnsafeConditionDetails')->name('unsafeConditionDetails');
        Route::get('/UnsafeConditionsBy/{status}', 'UnsafeConditionsController@getUnsafeConditionByStatus')->name('unsafeConditionByStatus');
        Route::post('/deleteUnsafeCondition', 'UnsafeConditionsController@deleteUnsafeCondition')->name('deleteUC');
        //Cuidado del compañero
        Route::get('/getCompanionCare', 'CompanionCareController@readCompanionCare')->name('getCompanionCare');
        //Incidentes
        Route::get('/getIncidentTable', 'IncidentController@getIncidenteTable')->name('incidentTable');
        Route::get('/incidentDetails/{id}', 'IncidentController@getIncidentDetails')->name('incidentDetails');
        
        Route::group(['middleware' => ['auth','checkRole:ADMINISTRADOR']], function (){
            //Permisos soloo para los administradores y super usuarios 
            //----------------------------------------
    
            //Actualizar usuarios
            Route::post('/updateUser', 'UserController@updateUser')->name('updateuser');
            Route::post('/updateUserPass', 'UserController@updatePass')->name('updateuserpass');
            //Eliminar Usuario
            Route::post('/deleteUser', 'UserController@deleteUser')->name('deleteUser');
            //Incidentes
            Route::post('/updateIncident', 'IncidentController@updateIncident')->name('updateIncident');
            
            
            Route::group(['middleware' => ['auth','checkRole:SUPERUSUARIO']], function(){  

                Route::get('/comapaniesDepartments/index', 'CompaniesDepartmentsController@getCompaniesDepartments')->name('companiesAndDepartments');
                Route::get('/comapaniesDepartments/create', 'CompaniesDepartmentsController@getCreate')->name('companiesDepartmentsCreate');
                Route::post('/comapaniesDepartments/create', 'CompaniesDepartmentsController@postCreate');
                Route::get('/comapaniesDepartments/edit', 'CompaniesDepartmentsController@getEdit')->name('companiesDepartmentsEdit');
                Route::post('/comapaniesDepartments/edit', 'CompaniesDepartmentsController@postEdit');
                
            });
            
            
        });
        
    });
    
    
});

require __DIR__.'/auth.php';
