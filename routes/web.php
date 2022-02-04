<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use Laravel\Socialite\Facades\Socialite;
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

Route::get('hello', function () {
    $name = 'mohamed';
    $age = 25;
    return view('hello', [
        'name' => $name,
    ]);
});





Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create')->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store')->middleware('auth');
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit')->middleware('auth');
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update')->middleware('auth');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy')->middleware('auth');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show')->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




// auth.github
Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
})->name('auth.github');


Route::get('/auth/callback', function () {
    $githubUser = Socialite::driver('github')->user();
    // dd($githubUser);

    $user = User::where('email', $githubUser->email)->first();
    
    if ($user === null) {
        $user = User::create([
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'password' => $githubUser->token,
            'remember_token' => $githubUser->token,
            // 'github_refresh_token' => $githubUser->refreshToken,
        ]);
    }
 
    Auth::login($user);
    return redirect('/posts');
   
});



// for google+ api , go to : 
// https://support.google.com/cloud/answer/6158849?hl=en#zippy=

Route::get('/google/auth/redirect', function () {
    return Socialite::driver('google')->redirect();
})->name('auth.google');

Route::get('/google/auth/callback', function () {

    $googleUser = Socialite::driver('google')->user();
   
    $user = User::where('email', $googleUser->email)->first();
    
    if ($user === null) {
        $user = User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'password' => $googleUser->token,
            'remember_token' => $googleUser->token,
           
        ]);
    }
 
    Auth::login($user);
    return redirect('/posts');
   
});
