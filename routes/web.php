<?php

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
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

Route::get('/app', function (){
    return view('app');
});

Route::get('/reset-password/{token}', function ($token){
    return view('auth.password-reset', [
        'token' => $token
    ]);
})->middleware(['guest:'.config('fortify.guard')])
  ->name('password.reset');



Route::get('/shared/posts/{post}', function (\Illuminate\Http\Request $request, \App\Models\Post $post){

    return "Specially made just for you 💕 ;) Post id: {$post->id}";

})->name('shared.post')->middleware('signed');


if(\Illuminate\Support\Facades\App::environment('local')){

    // Route::get('/shared/videos/{video}', function (\Illuminate\Http\Request $request, $video){

    //     // if(!$request->hasValidRelativeSignature()){
    //     //     abort(401);
    //     // }

    //     return 'git gud';
    // })->name('share-video')->middleware('signed');

    // Lang::setLocale('en');
    // $trans = \Illuminate\Support\Facades\Lang::get('auth.failed');
    // $trans = __('auth.password');
    // $trans = __('auth.throttle', ['seconds' => 5]);
    // // current locale
    // dump(\Illuminate\Support\Facades\App::currentLocale());
    // dump(App::isLocale('en'));

    // $trans = __('this is sparta');
    // $trans = trans_choice('auth.pants', 2);
    // $trans = trans_choice('auth.apples', 2, ['baskets' => 2]);
    // $trans = __('auth.welcome', ['name' => 'sam']);

    // dd($trans);

    Route::get('/playground', function (\Illuminate\Http\Request $request){
        // $user = \App\Models\User::factory()->make();
        // Mail::to($user)
        //     ->send(new WelcomeMail($user));
       //return null;


    //    $url = URL::temporarySignedRoute('share-video', now()->addSecond(30), [
    //         'video' => 123
    //    ]);
    //    return $url;

        event(new \App\Events\ChatMessageEvent('message', auth()->user()));
        return null;

    });

    Route::get('/ws', function () {
        return view('websocket');
    });

    Route::post('/chat-message', function (\Illuminate\Http\Request $request){
        event(new \App\Events\ChatMessageEvent($request->message, auth()->user()));
        return null;
    });
}

