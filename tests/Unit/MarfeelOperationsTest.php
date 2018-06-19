<?php

namespace App\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class MarfeelOperationsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCheckIsMarfeelizableTrue()
    {
        $marfeelOperations = new MarfeelOperations;
        $this->assertEquals($marfeelOperations->checkIsMarfeelizable('bbc.com/news'),true);
    } 

    public function testCheckIsMarfeelizableFalse()
    {
        $marfeelOperations = new MarfeelOperations;
        $this->assertEquals($marfeelOperations->checkIsMarfeelizable('google.com'),false);
    } 

    public function testCheckIsMarfeelizableNull()
    {
        $marfeelOperations = new MarfeelOperations;
        $this->assertEquals($marfeelOperations->checkIsMarfeelizable('randomurlijustinvented.com/'), null);
    } 

    public function testTextHasWordExistsEN()
    {
        $marfeelOperations = new MarfeelOperations;
        $this->assertEquals($marfeelOperations->textHasWord('news','Home - BBC News'),true);
    } 

    public function testTextHasWordExistsES()
    {
        $marfeelOperations = new MarfeelOperations;
        $this->assertEquals($marfeelOperations->textHasWord('noticias','Home - BBC Noticias'),true);
    } 

    public function testTextHasWordExistsESaccent()
    {
        $marfeelOperations = new MarfeelOperations;
        $this->assertEquals($marfeelOperations->textHasWord('notícias','Home - BBC Notícias'),true);
    } 

    public function testTextHasWordExistsNotES()
    {
        $marfeelOperations = new MarfeelOperations;
        $this->assertEquals($marfeelOperations->textHasWord('noticias','Home - BBC broadcasting'),false);
    } 
    
    public function testCheckTitleExists()
    {
        $marfeelOperations = new MarfeelOperations;
        $this->assertEquals($marfeelOperations->checkTitle('Home - BBC Noticias'),true);
    } 

    public function testCheckTitleExistsNot()
    {
        $marfeelOperations = new MarfeelOperations;
        $this->assertEquals($marfeelOperations->checkTitle('Home - BBC broadcasting'),false);
    } 

}
