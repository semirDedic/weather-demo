<?php

use App\Http\Requests\StoreWeatherRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/weather', function(StoreWeatherRequest $request){

    // Retrieve the validated input data
    $validated = $request->validated();

    $lat = $validated['latitude'];
    $lon = $validated['longitude'];
    $timezone = $validated['timezone'];

    $response = Http::get("api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&current=temperature_2m,apparent_temperature,weather_code&daily=weather_code,temperature_2m_max,temperature_2m_min&timezone=$timezone");
    
    return $response->json();
})->name('get_weather');
