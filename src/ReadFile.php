<?php
namespace  Sridharkalaibala;
/**
 * ReadFile Class
 *
 * The class is used to read log file page wise
 *
 * @package    Sridharkalaibala
 * @subpackage ReadFile
 * @author     Sridhar Balasubramanian <bala.phpdev@gmail.com>
 */
class ReadFile
{
    public $file = null;
    public $lines = 10;
    public $output = [];

    /**
     * Class Constructor - Initializing file reader
     *
     */
    public function __construct($file)
    {
        $this->file = new \SplFileObject($file);
    }

    /**
     * Reads 10 lines and returns the array of lines
     *
     * @return array Returns array of lines
     */
    public function readPage()
    {
        $i = 0;
        while(!$this->file->eof()) {
            $i++;
            $this->output[] = ['line'=>$this->file->fgets(),'no'=>$this->file->key()+1];
            if($i == $this->lines){
                break;
            }
        }
        return $this->output;
    }

    /**
     * Reads Nth Page and line, returns the 10 lines of array
     *
     * @param int  $page value of which page
     * @return array Returns array of lines
     */
    public function readNthPage($page)
    {
        $this->file->seek(($page * $this->lines)-2); // Minus 2 because count starts with 0 and reading current line
        return $this->readPage();
    }

    /**
     * Reads Last 10 lines and returns the array of lines
     *
     * @return array Returns array of lines
     */
    public function readLastPage()
    {
        $this->file->seek($this->file->getSize());
        $this->file->seek($this->file->key() - $this->lines);
        return $this->readPage();
    }

    /**
     * Class Destructor - Closing file reader
     *
     */
    public function __destruct()
    {
        $this->file = null;
    }

}