<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use App\Models\Alerts;

use App\Events\AlertsEvent;
use App\Models\Categories;
use App\Models\Dci;
use App\Models\Source;
use GuzzleHttp\Psr7\Message;

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
                    // Alerts::create($alert);
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
            $Alert= Alerts::with('dci','source','categories')->find($id);
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
            $response = Http::timeout(200)->post('http://127.0.0.1:5000/generate',
                [
                    "message" => "getdata in one task",
                    "url" => $link
                ]
            );
            $data = $response['data'];

            if (is_string($data)) {
                $decoded  = json_decode($data);
            }
            
            if (is_object($decoded) && isset($decoded->data)) {
                $records = $decoded->data; // Access property with object syntax
            }else {
                $records = [] ;
            }
            foreach ($records as $value) 
            {
                $idDci = Dci::where('name', $value['dci'])->first();
                $idCategories = Categories::where('name', $value['Category'])->first();
                try {
                    $alert = Alerts::create(
                        [
                            'dci_id' => $idDci->id,
                            'source_id' => $value,
                            "title"=>$value["title"],
                            "laboratoire"=>$value["laboratoire"],
                            'news_link' => $link,
                            'summary' =>  $value['simmary'],
                            'risk'=>$value['risk'],
                            'category_id' => $idCategories->id,
                            'news_date' => $value['date'],
                            'country_concerned' => $value['country'],
                        ]
                    );
                    return response()->json($alert, 200);
                    event(new AlertsEvent($alert));
                }
                catch (\Exception $e) {
                    return response()->json(['error' => 'Something went wrong'], 500);
                }
            }
        }
        return response()->json("alerts saved ! ", 200);
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
       
    }

    public function getApi(){
        $response = Http::get('http://127.0.0.1:8000/api/alertsysteme/');
        return $data->sendResponse($response->json());
    }
    

}
