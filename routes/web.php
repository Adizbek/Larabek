<?php

use Adizbek\Larabek\Controllers\AdminController;

Route::prefix(config('admin.route_prefix'))->group(function () {
    Route::prefix('api')->group(function () {
        Route::post('/entities', [AdminController::class, 'entities']);
        Route::post('/list/{entity}', [AdminController::class, 'list']);
        Route::post('/details/{entity}/{id}', [AdminController::class, 'details']);
        Route::get('/form/{entity}/{id?}', [AdminController::class, 'form']);
        Route::post('/form/{entity}/{id?}', [AdminController::class, 'formPost']);
        Route::post('/action/{entity}/{action}', [AdminController::class, 'action']);
    });

    Route::get('/{path?}', [AdminController::class, 'index'])->where('path', '.+');
});

?>
