<?php

use App\Http\Controllers\UploadController;
use App\Models\Asset;
use Illuminate\Support\Facades\Auth;
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
    if(Auth::check()) {
        return redirect('dashboard');
    }
    return redirect('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $assets = Asset::whereBelongsTo(Auth::user())->get();
        return view('dashboard', ['assets' => $assets]);
    })->name('dashboard');

    Route::post('/upload/{profile?}', UploadController::class)->name('upload')->defaults('profile', NULL);
    Route::view('/upload', 'upload')->name('upload');

    Route::prefix('/asset/{asset_id}')->whereUuid('asset_id')->group(function(\Illuminate\Routing\Router $router) {
        Route::get('/', function() use ($router) {
            return Asset::loadByAssetId($router->input('asset_id')) ?? response('Not Found.', 404);
        });
        Route::get('/download', function() use ($router){
            $asset = Asset::loadByAssetId($router->input('asset_id'));
           //return "An asset will be downloaded soon.";
           return response()->download(public_path($asset->path));
        })->name('download');

        // @TODO: Make it a post request.
        Route::get('/delete', function() use ($router) {
            $asset = Asset::loadByAssetId($router->input('asset_id'));
            $asset->delete();
            //return "An asset will be downloaded soon.";
            return redirect('dashboard');
        })->name('delete');

        Route::get('/edit', function() use ($router) {
            $asset = Asset::loadByAssetId($router->input('asset_id'));
            return view('asset-edit', ['asset' => $asset]);
        })->name('edit');
    });
});
