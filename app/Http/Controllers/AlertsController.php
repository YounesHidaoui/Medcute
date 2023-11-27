<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use App\Models\Alerts;


use App\Models\Categories;
use App\Models\Dci;
use App\Models\Source;

class AlertsController extends Controller
{

    public function index()
    {
        try {

            $Alerts = Alerts::with('dci','source','categories')->get();
            

            return response()->json($Alerts, 200);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }

    }

   
    
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'dci_id'=>'required|integer',
                'source_id'=>'required|integer',
                'news_link'=>'required|string',
                'summary'=>'required|string',
                'risk'=>'required|string',
                'category_id'=>'required|integer',
                'news_date'=>'required|date',
                'country_concerned'=>'required|string'
                ]
            ); 
    
            try {
                $alert = Alerts::create([
                        'dci_id' => $request->input('dci_id'),
                        'source_id' => $request->input('source_id'),
                        'news_link' => $request->input('news_link'),
                        'summary' => $request->input('summary'),
                        'risk' => $request->input('risk'),
                        'category_id' => $request->input('category_id'),
                        'news_date' => $request->input('news_date'),
                        'country_concerned' => $request->input('country_concerned'),
                    ]);
        
                    return response()->json($alert, 200);
                }
            catch (\Exception $e) {
                  
                    return response()->json(['error' => 'Something went wrong',$e], 500);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $Alert= Alerts::find($id);
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
        $request->validate([
            'dci_id' => 'required|numeric',
            'source_id' => 'required|numeric',
            'news_link' => 'required|url',
            'summary' => 'required|string',
            'risk'=>'required|string',
            'category_id' => 'required|numeric',
            'news_date' => 'required|date',
            'country_concerned' => 'required|string',
        ]);

        $alert = Alerts::findOrFail($id);

        $alert->update([
            'dci_id' => $request->input('dci_id'),
            'source_id' => $request->input('source_id'),
            'news_link' => $request->input('news_link'),
            'summary' => $request->input('summary'),
            'risk' => $request->input('risk'),
            'category_id' => $request->input('category_id'),
            'news_date' => $request->input('news_date'),
            'country_concerned' => $request->input('country_concerned'),
        ]);

        return response()->json(['message' => 'Alert updated successfully', 'data' => $alert]);
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

    public function AlertSysteme()
    {

       
        
        
        $DciList = Dci::pluck('name')->toArray();
        $CategoriesList = Categories::pluck('name')->toArray();
        $SourceList = Source::pluck('website')->toArray();

        if($DciList || $CategoriesList || $SourceList)
        {
            foreach ($SourceList as $link) 
            {
                $response = Http::get('http://127.0.0.1:8000/api/alertsysteme',

                [
                    'link'=>$link,'DciList'=>$DciList,'CategoriesList'=>$CategoriesList
                ]);

                    foreach ($response as $value) 
                    {
                        $idDci = Dci::find($value['dci']);
                        $idCategories = Categories::find($value['Category']);
                        try {
                            $alert = Alerts::create(
                                [
                                    'dci_id' => $idDci->id,
                                    'source_id' => $value,
                                    'news_link' => $value,
                                    'summary' =>  $value ,
                                    'risk'=>$value['risk'],
                                    'category_id' => $idCategories->id,
                                    'news_date' => $value,
                                    'country_concerned' => $value,
                                ]
                            );
                                return response()->json($alert, 200);
                            }
                        catch (\Exception $e) {
                            
                                return response()->json(['error' => 'Something went wrong'], 500);
                        }
                    }
            
                $responseData = $response->json();
                
            }
          
        }
       
        
    }


    public function AllData (){
        $Data = [
                                        'dci_id' => '1',
                                        'source_id' => '1',
                                        'news_link' => 'www.google.com',
                                        'summary' =>  'lorem testing' ,
                                        'risk'=>'100%',
                                        'category_id' => '1',
                                        'news_date' => '20-10-2023',
                                        'country_concerned' => 'maroc',
        ];
       
     

        return $Data;
       
        
        // return $alert;
    }

}
