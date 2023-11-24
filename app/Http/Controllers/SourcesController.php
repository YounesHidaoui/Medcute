<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Source;
use App\Imports\SourceImport;
use Maatwebsite\Excel\Facades\Excel;

class SourcesController extends Controller
{
    /**
     * Display a listing of the reSource.
     */
    public function index()
    {
        try {
            $AllSources = Source::all();
            return response()->json($AllSources, 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
        

    }

    /**
     * Show the form for creating a new reSource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created reSource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'continent'=>'required|string',
            'country'=>'required|string',
            'sigle'=>'required|string',
            'agence'=>'required|string',
            'website'=>'required|string'
        ]);
        try {
            $source = Source::create([
                'continent' => $request->input('continent'),
                'country' => $request->input('country'),
                'sigle' => $request->input('sigle'),
                'agence' => $request->input('agence'),
                'website' => $request->input('website'),
            ]);
            return response()->json($source, 200);

        } catch (\Exception $e) {
           return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $source= Source::find($id);
            if (!$source) {
                throw new \Exception('Ops source not found');
            }
            return response()->json($source, 200);

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
         $rules = [
            'continent'=>'required|string',
            'country'=>'required|string',
            'sigle'=>'required|string',
            'agence'=>'required|string',
            'website'=>'required|string'
        ];

        $request->validate($rules);

        try {
           
            $source = Source::find($id);

            if($source){
                $source->update([
                    'continent' => $request->input('continent')?? $source->continent,
                    'country' => $request->input('country')?? $source->country,
                    'sigle' => $request->input('sigle')?? $source->sigle,
                    'agence' => $request->input('agence')?? $source->agence,
                    'website' => $request->input('website')?? $source->website,
                ]);
                 return response()->json($source, 200);
            }else{
                return response()->json(['message' => 'Source not found '],400);
            }
           
        } catch (\Exception $e) {
            // Handle any exceptions (e.g., record not found)
            return response()->json(['Ops error' => $e->getMessage()], 500);
        }
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $source = Source::findOrFail($id);

            if (!$source) {
                throw new \Exception('Ops source not found');
            }

            $source->delete();

            return response()->json(['message' => 'source deleted successfully'], 200);

        } catch (\Exception $e) {

            Log::error($e->getMessage());
            
            return response()->json(['error' => 'Ops Something went wrong'], 500);
        }
    }

    public function ImportData(Request $request){

       
        Excel::import(new SourceImport, $request->file('file')->store('files'));

        
        

    }
}
