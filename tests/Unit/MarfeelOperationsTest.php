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
    public function testCheckIsMarfeelizable()
    {
        $marfeelOperations = new MarfeelOperations;
        $this->assertEquals($marfeelOperations->checkIsMarfeelizable('bbc.com/news'),true);
    } 
}
