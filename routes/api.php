<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Models\Categorie;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// api rest application configuration
Route::get('CategorieAll', [CategorieController::class, 'index']); // Lire toutes les catégories
Route::get('Categorie/{id}', [CategorieController::class, 'show']); // Lire une catégorie
Route::post('CategorieSave', [CategorieController::class, 'store']); // Ajouter une catégorie
Route::put('CategorieEdit/{id}', [CategorieController::class, 'update']); // Mettre à jour une catégorie
Route::delete('CategorieDelete/{id}', [CategorieController::class, 'destroy']); // Supprimer une catégorie




