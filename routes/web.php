<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SSO\SSOController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/sso/login",[SSOController::class,'getLogin'])->name("sso.login");
Route::get("/callback",[SSOController::class,'getCallback'])->name("sso.callback");
Route::get("/sso/connect",[SSOController::class,'connectUser'])->name("sso.connect");
// Route::get('/login',function(Request $request){
//     $request->session()->put("state",$state = Str::random(40));
//     $query = http_build_query([
//         "client_id" => "95d76aa3-c6c8-4349-9654-372a7c8e2ffd",
//         "redirect_uri" => "http://127.0.0.1:8080/callback",
//         "response_type" => "code",
//         "scope" => "view-user",
//         "state" => $state
//     ]);
//     return redirect("http://127.0.0.1:8000/oauth/authorize?" . $query);
// });

// Route::get('/callback',function(Request $request){
//     $state = $request->session()->pull("state");
//     // return $state;
//     throw_unless(strlen($state) > 0 && $state == $request->state,
//         InvalidArgumentException::class);
//     $response = Http::asForm()->post(
//         "http://127.0.0.1:8000/oauth/token",
//         [
//             "grant_type" => "authorization_code",
//             "client_id" => "95d76aa3-c6c8-4349-9654-372a7c8e2ffd",
//             "client_secret" => "lJAEIOZsH9qwkRdBcMfDdj2A9nsmbcceU6YNcX66",
//             "redirect_uri" => "http://127.0.0.1:8080/callback",
//             "code" => $request->code
//         ]
//     );
//     $request->session()->put($response->json());
//     return redirect("/authuser");
// });

// Route::get('/authuser', function(Request $request){
//     $access_token = $request->session()->get("access_token");
//     $response = Http::withHeaders([
//         "Accept" => "application/json",
//         "Authorization" => "Bearer " . $access_token
//     ])->get("http://127.0.0.1:8000/api/user");
//     return $response->json();
// });


Auth::routes(['register' => false, 'reset' => false]);

// Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
