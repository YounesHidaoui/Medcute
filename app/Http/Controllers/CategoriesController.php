<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $AllCategories = Categories::all();
            return response()->json($AllCategories, 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|string',
                ]); 
    
            try {
                    $categorie = Categories::create([
                        'name' => $request->input('name'),
                    ]);
                    return response()->json($categorie, 200);
                }
                catch (\Exception $e) {
                  
                    return response()->json(['error' => 'Something went wrong'], 500);
                }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $Categorie= Categories::find($id)->get();
            if (!$categorie) {
                throw new \Exception('Ops Categ$categorie not found');
            }
            return response()->json($Categorie, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $Categorie = Categories::find($id);

            if (!$Categorie) {
                throw new \Exception('Ops Cat$Categorie not found');
            }
            $Categorie->delete();

            return response()->json(['message' => 'Categorie deleted successfully'], 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            
            return response()->json(['error' => 'Ops Something went wrong'], 500);
        }
    }
}
