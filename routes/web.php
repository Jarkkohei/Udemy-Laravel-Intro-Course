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
    return view('home');
})->name('home');


Route::group(['prefix' => 'do'], function() {
    Route::get('/greet/{name?}', function ($name = null) {
        return view('actions.greet', ['name' => $name]);
    })->name('greet');
    
    
    Route::get('/hug', function () {
        return view('actions.hug');
    })->name('hug');
    
    
    Route::get('/kiss', function () {
        return view('actions.kiss');
    })->name('kiss');
    
    
    Route::post('/', function (\Illuminate\Http\Request $request) {
    
        // Check if the values for select-input named "action" and the input-field named "name" have been given. 
        if(isset($request['action']) && $request['name']) {
    
            // Check if the input-field named "name" is not empty.
            if(strlen($request['name']) > 0) {
                // Return view named "nice" with an array including the "action" and the "name".
                return view('actions.nice', ['action' => $request['action'], 'name' => $request['name']]);
            }
            return redirect()->back();
        }
        return redirect()->back();
    })->name('benice');
});