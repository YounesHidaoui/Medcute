<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Alerts;

class AlertsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $Alerts = Alerts::all();
            return response()->json($Alerts, 200);

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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dci_id'=>'required|numeric',
            'soucre_id'=>'required|numeric',
            'news_link'=>'string',
            'summary'=>'required|string|max:255',
            'category_id'=>'required|numeric',
            'news_date'=>'date',
            'country_concerned'=>'string'

                ]); 
    
            try {
                    $alert = Alerts::create([
                        'dci_id' => $request->input('dci_id'),
                        'soucre_id' => $request->input('soucre_id'),
                        'news_link' => $request->input('news_link'),
                        'summary' => $request->input('summary'),
                        'category_id' => $request->input('category_id'),
                        'news_link' => $request->input('news_link'),
                        'news_date' => $request->input('news_date'),
                        'country_concerned' => $request->input('country_concerned'),
                    ]);
                    return response()->json($alert, 200);
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
            $Alert= Alerts::find($id)->get();
            if (!$Alert) {
                throw new \Exception('Ops Alert not found');
            }
            return response()->json($Alert, 200);
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
            $alert = Alerts::find($id);

            if (!$alert) {
                throw new \Exception('Ops alert not found');
            }

            $alert->delete();

            return response()->json(['message' => 'alert deleted successfully'], 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            
            return response()->json(['error' => 'Ops Something went wrong'], 500);
        }
    }
}
