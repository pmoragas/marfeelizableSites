<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Site;


class SitesController extends Controller
{
    

    
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

        if($this->checkInput($input)){
            foreach ($input as $site) {
                if($this->checkElement($site)){
                    $isMarfeelizable = $marfeelOperations->checkIsMarfeelizable($site['url']);

                    if($isMarfeelizable == true){
                        //isMarfeelizable -> 1
                        $site['isMarfeelizable'] = 1;
                        Site::create($site);
                    } else if ($isMarfeelizable == false){
                        //isMarfeelizable -> 0
                        $site['isMarfeelizable'] = 0;
                        Site::create($site);
                    }
                }
                
                
            }
        } else {
            abort(400);
        }

        return $request;
        
    }

    // I: array
    // O: true if the array contains more than 0 elements and has the 'url' set / false otherwise
    public function checkInput(array $input){

        if(is_array($input)){
            if(count($input) > 0){
                if(isset($input['url'])){
                    return false;
                } else {
                    return true;
                }
            }
        }

        return false;
    }

    // I: array
    // O: true if the array contains the key 'url' / false otherwise
    public function checkElement(array $input){

        if(isset($input['url'])){
            return true;
        } else {
            return false;
        }
        
    }

}




