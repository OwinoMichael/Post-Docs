<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    //'auth'
])
->prefix('heyaa')
    ->as('posts.') //same as name()
    //->name('posts.')
    //->namespace("\App\Http\Controllers") //used to find controllers //Magical
    ->group(function () {

        Route::get('/posts', [\App\Http\Controllers\PostController::class, 'index'])
            ->name('index')
            ->withoutMiddleware('auth') //remove middleware from a particular route
        ;
       // Route::get('/posts', 'PostController@index')->name('index');

        Route::get('/posts/{post}', [\App\Http\Controllers\PostController::class, 'show'])
            ->name('show')
          //  ->where('post', '[0-9]+')
            ->whereNumber('post')
        ;

        Route::post('/posts', [\App\Http\Controllers\PostController::class, 'store'])->name('store');

        Route::patch('/posts/{post}', [\App\Http\Controllers\PostController::class, 'update'])->name('update');

        Route::delete('/posts/{post}', [\App\Http\Controllers\PostController::class, 'destroy'])->name('destroy')->whereNumber('post');
});
