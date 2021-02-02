<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('home')->with('status', session('status'));
    }

    return redirect()->route('home');
});

Auth::routes(['register' => false]);
// Admin

//]]Route::group(['prefix' => 'dafac', 'as' => 'dafac.', 'namespace' => 'Dafac', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');


    //Division
    Route::delete('divisions/destroy', 'DivisionsController@massDestroy')->name('divisions.massDestroy');
    Route::resource('divisions', 'DivisionsController');
    
    //Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/reportHousingCondition', 'DashboardController@reportHousingCondition')->name('reportHousingCondition');
    Route::get('/reportVulSector', 'DashboardController@reportVulSector')->name('reportVulSector');
    Route::get('/reportDisIndividual', 'DashboardController@reportDisIndividual')->name('reportDisIndividual');


    //Disaster Libraries
    Route::delete('disaster/destroy', 'DisasterController@massDestroy')->name('disaster.massDestroy');
    Route::resource('disaster','DisasterController');
    //Dafac
    Route::get('/deleteDafac/{id}', ["as" => "dafac.delete", "uses" => "DafacController@deleteDafac"]); 
    Route::get('/searchDafac', ["as" => "dafac.searchDafac", "uses" => "DafacController@searchDafac"]);
    Route::get('/search', 'DafacController@search');
    Route::resource('dafac','DafacController');
    //Dafac Roster
    Route::get('/deleteRoster/{id}', ["as" => "roster.delete", "uses" => "RosterController@deleteRoster"]); 
    Route::resource('roster','RosterController');

    //Evacuation Libraries
    Route::get('viewProfile/{id}', ["as" => "roster.viewProfile", 'uses' =>'RosterController@viewProfile']);
    Route::get('/deleteEvacSite/{id}', ["as" => "evacSite.delete", "uses" => "EvacSiteController@deleteEvacSite"]);   
    Route::resource('evacSite','EvacSiteController');
     

    //Health Condition LIbraries
    Route::resource('hc','HealthConditionController');   
    Route::resource('vulnerability','VulnerabilityController');   


//});
