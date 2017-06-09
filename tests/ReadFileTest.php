<?php

use Sridharkalaibala\ReadFile;

class ReadFileTest extends PHPUnit_Framework_TestCase
{
    public function test_read_file_Success()
    {
        $file = new ReadFile('tests/files/log.txt');
        $array = $file->readPage();
        $this->assertTrue(is_array($array));
    }

    public function test_read_file_Failure()
    {
        $this->expectException(RuntimeException::class);
        $file = new ReadFile('sdfdsf.txt'); //File not exist
    }

    public function test_read_file_Count()
    {
        $file = new ReadFile('tests/files/log.txt');
        $array = $file->readPage();
        $this->assertEquals(10, count($array));
    }

    public function test_read_file_last()
    {
        $file = new ReadFile('tests/files/log.txt');
        $array = $file->readLastPage();
        $expected = '[{"line":"fkg last line6\r\n","no":96},{"line":"fkg last line7\r\n","no":97},{"line":"fkg last line8\r\n","no":98},{"line":"fkg last line44\r\n","no":99},{"line":"fgdfgfdgdfg\r\n","no":100},{"line":"dfg\r\n","no":101},{"line":"fd\r\n","no":102},{"line":"gdfg\r\n","no":103},{"line":"df\r\n","no":104},{"line":"gdf last","no":105}]';
        $this->assertEquals($expected, json_encode($array));
    }

    public function test_read_file_nth_page()
    {
        $file = new ReadFile('tests/files/log.txt');
        $array = $file->readNthPage(3);
        $expected = '[{"line":"fsd sdsdf sdfdsfd\r\n","no":30},{"line":"sdfsdaf sdfsdfsdfsdsd\r\n","no":31},{"line":"sdfsd sdfsdf\r\n","no":32},{"line":"f sdfsdfsdf\r\n","no":33},{"line":"sdfs dfsdfdsf 54765\r\n","no":34},{"line":"sdfsdfsdfsdfds\r\n","no":35},{"line":"sdf\r\n","no":36},{"line":"dsf\r\n","no":37},{"line":"sd\r\n","no":38},{"line":"f\r\n","no":39}]';
        $this->assertEquals($expected, json_encode($array));
    }

}