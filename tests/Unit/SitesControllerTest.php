<?php

namespace App\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class SitesControllerTest extends TestCase
{
    
    public function testCheckInputFalse()
    {
        
        $sitesController = new SitesController;
        $input = array('url' => 'bbc.com', 'rank' => 1234);
        
        
        $this->assertEquals($sitesController->checkInput($input),false);
    } 

    public function testCheckInputTrue()
    {
        
        $sitesController = new SitesController;
        $input = array(array('url' => 'bbc.com', 'rank' => 1234),array('url' => 'w3schools.com', 'rank' => 1234));
        
        
        $this->assertEquals($sitesController->checkInput($input),true);
    } 

    public function testCheckElementTrue()
    {
        
        $sitesController = new SitesController;
        $input = array('url' => 'bbc.com', 'rank' => 1234);
        
        $this->assertEquals($sitesController->checkElement($input),true);
    } 

    public function testCheckElementFalse()
    {
        
        $sitesController = new SitesController;
        $input = array('rank' => 1234);
        
        $this->assertEquals($sitesController->checkElement($input),false);
    } 


}
