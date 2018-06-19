<?php

namespace App\Http\Controllers;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

//require(__DIR__.'/../../app/Includes/WebCrawler.php');

class WebCrawlerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetTitleBasic()
    {
        $webCrawler = new WebCrawler;
        $this->assertEquals($webCrawler->get_title('<title>Home - BBC News</title>'),'Home - BBC News');
    }

    public function testGetTitleBasic2()
    {
        $webCrawler = new WebCrawler;
        $this->assertEquals($webCrawler->get_title('<title>YouTube</title>'),'YouTube');
    }

    public function testGetTitleNull()
    {
        $webCrawler = new WebCrawler;
        $this->assertEquals($webCrawler->get_title(null),null);
    }

    public function testGetWebPageERROR()
    {
        $webCrawler = new WebCrawler;
        $webPage = $webCrawler->get_web_page('randomurlijustinvented.com/');
        $this->assertEquals($webPage['content'],false);
    }

    public function testGetWebPageOK()
    {
        $webCrawler = new WebCrawler;
        $webPage = $webCrawler->get_web_page('microsiervos.com');
        $this->assertEquals($webPage['http_code'],200);
    }
}
