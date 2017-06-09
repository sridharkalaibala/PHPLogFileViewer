<?php

class ApiTest extends PHPUnit_Framework_TestCase
{
    protected function setUp()
    {
       $this->url = 'http://localhost/PHPLogFileViewer/src/api.php'; // PLEASE REPLACE correct path
    }

    public function test_not_valid_request()
    {
        $content = file_get_contents($this->url);
        $this->assertContains('Request is not valid',$content);
    }

    public function test_not_valid_request_with_wrong_file()
    {
        $content = file_get_contents($this->url.'?file=sdfsd.txt&page=first');
        $this->assertContains('Request is not valid',$content);
    }

    public function test_not_valid_request_with_wrong_extension()
    {
        $content = file_get_contents($this->url.'?file=api.php&page=first');
        $this->assertContains('Only txt and log extensions allowed',$content);
    }

    public function test_read_first_page()
    {
        $content = file_get_contents($this->url.'?file=log.txt&page=first');
        $this->assertContains('sdfsdaf sdfsdfsdfsdsd',$content);
    }

    public function test_read_3rd_page()
    {
        $content = file_get_contents($this->url.'?file=log.txt&page=3');
        $this->assertContains('sdfsdaf sdfsdfsdfsdsd',$content);
    }

    public function test_read_last_page()
    {
        $content = file_get_contents($this->url.'?file=log.txt&page=last');
        $this->assertContains('gdf last',$content);
    }
}