<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dci;


class DciController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $Alldci = Dci::all();
            return response()->json($Alldci, 200);

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
                    $dci = Dci::create([
                        'name' => $request->input('name'),
                    ]);
                    return response()->json($dci, 200);
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
            $dci= Dci::find($id)->get();
            if (!$dci) {
                throw new \Exception('Ops Dci not found');
            }
            return response()->json($dci, 200);
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
            $dci = Dci::find($id);

            if (!$Dci) {
                throw new \Exception('Ops Dci not found');
            }

            $dci->delete();

            return response()->json(['message' => 'Dci deleted successfully'], 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            
            return response()->json(['error' => 'Ops Something went wrong'], 500);
        }
    }
}
