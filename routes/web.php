<?php

use Adizbek\Larabek\Controllers\AdminController;

Route::prefix(config('admin.route_prefix'))->group(function () {
    Route::get('/{path?}', [AdminController::class, 'index'])->where('path', '.+');

    Route::post('/entities', [AdminController::class, 'entities']);
    Route::post('/list/{slug}', [AdminController::class, 'list']);
});

?>
