<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudItemController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('add-item', [CrudItemController::class, 'addItem']);
Route::delete('delete-item/{id}',[CrudItemController::class, 'deleteItem']);
Route::put('edit-item/{id}', [CrudItemController::class, 'editItem']);
Route::get('all-item', [CrudItemController::class, 'allItem']);
Route::get('item-detail/{id}',[CrudItemController::class, 'itemDetails']);