<?php

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
Route::get('/login',function(Request $request){
    $request->session()->put("state",$state = Str::random(40));
    $query = http_build_query([
        "client_id" => "95d77e03-9ba3-4c0a-aa9c-c2c626d28459",
        "redirect_uri" => "http://127.0.0.1:8080/callback",
        "response_type" => "code",
        "scope" => "",
        "state" => $state
    ]);
    return redirect("http://127.0.0.1:8000/oauth/authorize?" . $query);
});

Route::get('/callback',function(Request $request){
    $state = $request->session()->pull("state");
    // return $state;
    throw_unless(strlen($state) > 0 && $state == $request->state,
        InvalidArgumentException::class);
    $response = Http::asForm()->post(
        "http://127.0.0.1:8000/oauth/token",
        [
            "grant_type" => "authorization_code",
            "client_id" => "95d77e03-9ba3-4c0a-aa9c-c2c626d28459",
            "client_secret" => "sLzGscKT6VWt2vzwPQotTTn2ti00dicBCO4MR9Tp",
            "redirect_uri" => "http://127.0.0.1:8080/callback",
            "code" => $request->code
        ]
    );
    return $response->json();
});
