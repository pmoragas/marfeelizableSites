<?php 

namespace App\Http\Controllers;


    class WebCrawler {
        
        // I: Url
        // O: content, errors of web accessed with input Url
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

        

    }

?>