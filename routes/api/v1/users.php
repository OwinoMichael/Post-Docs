<?php

//Route::apiResource('users', [\App\Http\Controllers\UserController::class]);

//use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;

//Array Syntax

// Route::group([
//     'midlleware' => [
//         'auth',
//     ],
//     'prefix' => 'heyaa',
//     'as' => 'users',
//     'namespace' => '\App\Http\Controllers',
// ], function(){
//     Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('index');
//        // Route::get('/users', 'UserController@index')->name('index');

//         Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('show');

//         Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('store');

//         Route::patch('/users', [\App\Http\Controllers\UserController::class, 'update'])->name('update');

//         Route::delete('/users', [\App\Http\Controllers\UserController::class, 'destroy'])->name('destroy');

// });


//Method Syntax

Route::middleware([
    //'auth'
])

    ->prefix('heyaa')
    ->as('users.') //same as name()
    //->name('users.')
    //->namespace("\App\Http\Controllers") //used to find controllers //Magical
    ->group(function () {

        Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])
            ->name('index')
            ->withoutMiddleware('auth') //remove middleware from a particular route
        ;
       // Route::get('/users', 'UserController@index')->name('index');

        Route::get('/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])
            ->name('show')
          //  ->where('user', '[0-9]+')
            ->whereNumber('user')
        ;

        Route::post('/users', [\App\Http\Controllers\UserController::class, 'store'])->name('store');

        Route::patch('/users', [\App\Http\Controllers\UserController::class, 'update'])->name('update');

        Route::delete('/users', [\App\Http\Controllers\UserController::class, 'destroy'])->name('destroy');
});


