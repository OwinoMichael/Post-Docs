<?php

use Illuminate\Support\Facades\Route;

Route::middleware([
    //'auth',

])

->prefix('heyaa')
->as('users.') //same as name()
//->name('users.')
//->namespace("\App\Http\Controllers") //used to find controllers //Magical

->group(function () {

    Route::get('/comments', [\App\Http\Controllers\CommentController::class, 'index'])
            ->name('index')
            ->withoutMiddleware('auth') //remove middleware from a particular route
        ;
       // Route::get('/comments', 'CommentsController@index')->name('index');

        Route::get('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'show'])
            ->name('show')
          //  ->where('comments', '[0-9]+')
            ->whereNumber('comments')
        ;

        Route::post('/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('store');

        Route::patch('/posts/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])->name('update');

        Route::delete('/comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('destroy');

});


