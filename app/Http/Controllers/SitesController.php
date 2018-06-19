<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Site;


class SitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::all();
        return $sites;
    }

    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $marfeelOperations = new MarfeelOperations;

        //check if array
        if(is_array($input)){
            
            //loop through json array
            foreach ($input as $site) {
                
                $isMarfeelizable = $marfeelOperations->checkIsMarfeelizable($site['url']);
                //return response()->json($isMarfeelizable);

                if($isMarfeelizable == true){
                    //isMarfeelizable -> 1
                    $site['isMarfeelizable'] = 1;
                    Site::create($site);
                } else if ($isMarfeelizable == false){
                    //isMarfeelizable -> 0
                    $site['isMarfeelizable'] = 0;
                    Site::create($site);
                } else {
                    //isMarfeelizable -> null 
                }
                
            }
        }

        return $request;
    }

}




