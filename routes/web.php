<?php

use Adizbek\Larabek\Controllers\AdminController;

Route::prefix(config('admin.route_prefix'))->group(function () {
    Route::get('/{path?}', [AdminController::class, 'index'])->where('path', '.+');

    Route::post('/entities', [AdminController::class, 'entities']);
    Route::post('/list/{entity}', [AdminController::class, 'list']);
    Route::post('/details/{entity}/{id}', [AdminController::class, 'details']);
    Route::post('/action/{entity}/{action}', [AdminController::class, 'action']);
});

?>
