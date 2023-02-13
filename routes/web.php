<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


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

Route::get('/login', function () {
    return view('login');
})->name("login");
Route::get('/', function () {
    return redirect()->route("profile");
})->name("home");

Route::post('/login', [AuthController::class, "login"])->name("login.submit");
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route("login");
})->name("logout");
Route::get('/register', function () {
    return view('register');
})->name("register");

Route::post('/register', [AuthController::class, "register"])->name("register.submit");

Route::middleware(['auth'])->group(function(){
    Route::get("/profile", [ProfileController::class, "index"])->name("profile");
});

 

// social login
Route::get('/auth/facebook/redirect', function () {
    return  Socialite::driver('facebook')->asPopup()->redirect();
})->name('facebook.redirect');
Route::get('/auth/facebook/callback', [ AuthController::class, "facebookCallback" ])->name('facebook.callback');

Route::get('/auth/github/redirect', function () {
    return  Socialite::driver('github')->redirect();
})->name('github.redirect');
Route::get('/auth/github/callback', [ AuthController::class, "githubCallback" ])->name('github.callback');


Route::get('/auth/google/redirect', function () {
    return  Socialite::driver('google')->redirect();
})->name('google.redirect');
Route::get('/auth/google/callback', [ AuthController::class, "googleCallback" ])->name('google.callback');



Route::get('/auth/microsoft/redirect', function () {
    return Socialite::driver('microsoft')->redirect();
})->name('microsoft.redirect');
Route::get('/auth/microsoft/callback', [ AuthController::class, "microsoftCallback" ])->name('microsoft.callback');


Route::get('/auth/linkedin/redirect', function () {
    return Socialite::driver('linkedin')->redirect();
})->name('linkedin.redirect');
Route::get('/auth/linkedin/callback', [ AuthController::class, "linkedinCallback" ])->name('linkedin.callback');


Route::get("/linked", function(){
    $client = new \GuzzleHttp\Client();
    $headers = [
        'Content-Type' => 'application/x-www-form-urlencoded'
    ];
    $response = $client->post('https://www.linkedin.com/oauth/v2/accessToken?grant_type=authorization_code&client_id=77528z2okrto7o&client_secret=qHVaSyNkdFNXlgDq', $headers);
    // $res = $client->sendAsync($request)->wait();
    dd($response);
});
