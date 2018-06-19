<?php

    namespace App\Http\Controllers;

    

    class MarfeelOperations {


        //concentrates all checks for being marfeelizable
        public function checkIsMarfeelizable(string $url)
        {
            $webCrawler = new WebCrawler;
            // 1: Crawl the webpage 
            try {
                
                $data = $webCrawler->get_web_page($url);
                
            } catch (Exception $e){

            }
            
            // 2: Get title from webpage content
            if($data === null){
                $isMarfeelizable = null;
            } else {
                $title = $webCrawler->get_title($data['content']);
            }
            
            // 3: Check title
            if($title === null){    
                $isMarfeelizable = null;
            
            } else{
                $isMarfeelizable = $this->checkTitle($title);
            }
            

            return $isMarfeelizable;
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

        // I: title string
        // O: true if any of the keywords is found on title - false otherwise
        public function checkTitle(string $title){
            $isNews = $this->textHasWord('news',$title);
            $isNoticias = $this->textHasWord('noticias',$title);
            $isNoteecias = $this->textHasWord('notícias',$title);
            
            $isMarfeelizable = $isNews || $isNoticias || $isNoteecias; 
        }
    }

?>
