<?php

use App\Http\Controllers\UploadController;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //@TODO: Upload Asset with optional profile value.
    Route::post('/upload/{profile?}', UploadController::class);

    //@TODO: Download asset by given ID.
    Route::get('/download/{asset:asset_id}', function(Asset $asset) {
       //return ['msg' => "Asset with ID $asset->filename will be downloaded."];
       return response()->download(public_path($asset->path));
    })->whereUuid('asset_id');

    Route::get('/search/{query}', function ($query) {
        return response()->json(["query" => $query]);
    })->where('query', '.*');

    Route::get('/assets', function() {
       return Asset::all();
    });
});
