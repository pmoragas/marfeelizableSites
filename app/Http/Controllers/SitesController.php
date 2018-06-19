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

class MarfeelOperations {

    //concentrates all checks for being marfeelizable
    public function checkIsMarfeelizable(string $url)
    {
        $webCrawler = new WebCrawler;

        try {
            
            $data = $webCrawler->get_web_page($url);
            
        } catch (Exception $e){

        }
        
        if($data === null){
            $isMarfeelizable = null;
        } else {
            $title = $webCrawler->get_title($data['content']);
        }
        
        if($title === null){
            $isMarfeelizable = null;
        } else{
            $isNews = $webCrawler->textHasWord('news',$title);
            $isNoticias = $webCrawler->textHasWord('noticias',$title);
        
            $isMarfeelizable = $isNews || $isNoticias;
            //return $isMarfeelizable;
        }
        

        return $isMarfeelizable;
    }
}

class WebCrawler {
    
    // I: Url
    // O: content, errors from input Url
    public function get_web_page( $url ){
        set_time_limit(0);

        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "spider", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 30,      // timeout on connect
            CURLOPT_TIMEOUT        => 500,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYHOST => 0,        // don't verify HOST SSL
            CURLOPT_SSL_VERIFYPEER => 0,        // don't verify PEER SSL
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        
        return $header;
    }

    // I: all content of webpage
    // O: content between <title> tags 
    public function get_title($content){
        $res = preg_match("/<title>(.*)<\/title>/siU", $content, $title_matches);
        if (!$res) 
            return null; 

        // Clean up title: remove EOL's and excessive whitespace.
        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
        $title = trim($title);
        return $title;
    }

    // I: a text and a word
    // O: true if the word is inside the text / false otherwise
    public function textHasWord(string $word, string $text){
        $word = strtoupper($word);
        $text = strtoupper($text);

        if(strpos($text,$word) === false){
            return 0;
        } else {
            return 1;
        }
    }

}
