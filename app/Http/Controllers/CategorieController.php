<?php
namespace App\Http\Controllers;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    // Liste toutes les catégories
    public function index()
        {
            $categories = Categorie::select('id', 'nom', 'created_at', 'updated_at')->get();
            if ($categories->isEmpty()) {
                return response()->json([
                    'message' => 'Erreur catégorie non trouvée'
                ], 404);
            }

            // Manipuler les données pour ne renvoyer que 'id', 'nom' et 'created_at'
            $categoriesData = $categories->map(function($category) {
                return [
                    'id' => $category->id,
                    'nom' => $category->nom,
                    'timestamps' => $category->created_at
                ];
            });

            return response()->json([
                'data' => $categoriesData,
                'message' => 'Categories retrieved successfully'
            ], 200);
        }


    // Affiche une catégorie spécifique
    public function show($id)
        {

            $categorie = Categorie::find($id);

            if (!$categorie) {
                return response()->json([
                    'message' => 'Erreur catégorie non trouvée',
                ], 404);
            }

            $categorieData = [
                'id' => $categorie->id,
                'nom' => $categorie->nom,
                'timestamps' => $categorie->created_at
            ];

            return response()->json([
                'data' => $categorieData,
                'message' => 'Categorie retrieved successfully'
            ], 200);
        }


        public function store(Request $request)
        {
            $request->validate([
                'nom' => 'required|string|max:255',
            ]);

            // Création de la catégorie avec les données du front-end
            $categorie = Categorie::create([
                'nom' => $request->input('nom'), // Récupérer 'nom' depuis la requête
            ]);

            return response()->json([
                'data' => $categorie,
                'message' => 'Categorie created successfully',
            ], 201);
        }




        public function update(Request $request, $id)
        {
            $categorie = Categorie::find($id);

            if (!$categorie) {
                return response()->json(['message' => 'Categorie not found'], 404);
            }

            $request->validate([
                'nom' => 'required|string|max:255',
            ]);

            $categorie->update([
                'nom' => $request->input('nom'),
            ]);

            return response()->json([
                'data' => $categorie,
                'message' => 'Categorie updated successfully',
            ], 200);
        }


    // Supprime une catégorie
    public function destroy($id)
        {
            $categorie = Categorie::find($id);

            if (!$categorie) {
                return response()->json(['message' => 'Categorie not found'], 404);
            }

            $categorie->delete();

            return response()->json(['message' => 'Categorie deleted successfully'], 200);
        }

}
