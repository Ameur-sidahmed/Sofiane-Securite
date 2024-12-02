<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;

Route::post('/api/AjouterCat', [CategorieController::class, 'store']);
