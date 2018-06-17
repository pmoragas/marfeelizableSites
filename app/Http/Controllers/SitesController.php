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
        
        //check if array
        if(is_array($input)){
            
            //loop through json array
            foreach ($input as $site) {
                
                if($this->checkIsMarfeelizable($site['url'])){
                    //isMarfeelizable -> 1
                    $site['isMarfeelizable'] = 1;
                    Site::create($site);
                } else {
                    //isMarfeelizable -> 0
                    $site['isMarfeelizable'] = 0;
                    Site::create($site);
                }
            }
        }

        return $request;
    }

    //concentrates all checks for being marfeelizable
    function checkIsMarfeelizable(string $url)
    {

        $title_content = $this->page_title($url);
        
        $isNews = $this->textHasWord('news',$title_content);
        $isNoticias = $this->textHasWord('noticias',$title_content);
        
        $isMarfeelizable = $isNews or $isNoticias;

        return $isMarfeelizable;
    }

    //returns page title if available
    private function page_title($url) {
        $fp = file_get_contents("http://" . $url);
        if (!$fp) 
            return null;

        $res = preg_match("/<title>(.*)<\/title>/siU", $fp, $title_matches);
        if (!$res) 
            return null; 

        // Clean up title: remove EOL's and excessive whitespace.
        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
        $title = trim($title);
        return $title;
    }

    //returns TRUE if $word is inside $text
    private function textHasWord(string $word, string $text){
        if(strpos($text,$word) === false){
            return 0;
        } else {
            return 1;
        }
    }



}
