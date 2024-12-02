<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    // Afficher la liste des produits
    public function index()
    {
        $produits = Produit::all(); // Récupérer tous les produits
        return view('produits.index', compact('produits'));
    }

    // Afficher le formulaire de création d'un nouveau produit
    public function create()
    {
        $categories = Categorie::all(); // Récupérer toutes les catégories
        return view('produits.create', compact('categories'));
    }

    // Enregistrer un nouveau produit
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'prix_vente' => 'required|numeric',
            'prix_achat' => 'required|numeric',
            'quantite' => 'required|integer',
            'reference' => 'required|string|unique:produits,reference',
            'image' => 'nullable|image',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images/produits', 'public') : null;

        Produit::create([
            'nom' => $request->nom,
            'categorie_id' => $request->categorie_id,
            'description' => $request->description,
            'prix_vente' => $request->prix_vente,
            'prix_achat' => $request->prix_achat,
            'quantite' => $request->quantite,
            'reference' => $request->reference,
            'image' => $imagePath,
        ]);

        return redirect()->route('produits.index');
    }

    // Afficher les détails d'un produit spécifique
    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    // Afficher le formulaire d'édition d'un produit
    public function edit(Produit $produit)
    {
        $categories = Categorie::all(); // Récupérer toutes les catégories
        return view('produits.edit', compact('produit', 'categories'));
    }

    // Mettre à jour un produit existant
    public function update(Request $request, Produit $produit)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'prix_vente' => 'required|numeric',
            'prix_achat' => 'required|numeric',
            'quantite' => 'required|integer',
            'reference' => 'required|string|unique:produits,reference,' . $produit->id,
            'image' => 'nullable|image',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images/produits', 'public') : $produit->image;

        $produit->update([
            'nom' => $request->nom,
            'categorie_id' => $request->categorie_id,
            'description' => $request->description,
            'prix_vente' => $request->prix_vente,
            'prix_achat' => $request->prix_achat,
            'quantite' => $request->quantite,
            'reference' => $request->reference,
            'image' => $imagePath,
        ]);

        return redirect()->route('produits.index');
    }

    // Supprimer un produit
    public function destroy(Produit $produit)
    {
        $produit->delete();

        return redirect()->route('produits.index');
    }
}
