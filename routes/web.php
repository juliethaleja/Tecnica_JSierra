<?php

use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
/* API rick y morty */
Route::get('/character', [CharacterController::class, 'IndexCharacter']);
Route::get('/character/page/{id}', [CharacterController::class, 'ConsumirApixPage']);
Route::get('/character/{id}', [CharacterController::class, 'ConsumirApixDetail']);
/* Data Base */

Route::post('/stroedCharacter', [CharacterController::class, 'StoreBd']);
Route::post('/UpdCharacter', [CharacterController::class, 'UpdateCharacter']);
Route::post('/UpdOrigin', [CharacterController::class, 'UpdateOrigin']);
Route::get('/characterbd', function () {
    return App\Models\Characters::paginate(20);
});
Route::get('/characterbd/{id}', function ($id) {
    return App\Models\Characters::find($id);
});
