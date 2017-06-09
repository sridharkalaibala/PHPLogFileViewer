<?php
namespace  Sridharkalaibala;

class ReadFile
{
    public $file = null;
    public $lines = 10;
    public $output = [];
    public function __construct($file)
    {
        $this->file = new \SplFileObject($file);
    }

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

    public function readNthPage($line)
    {
        $this->file->seek(($line * $this->lines)-2); // Minus 2 because count starts with 0 and reading current line
        return $this->readPage();
    }

    public function readLastPage()
    {
        $this->file->seek($this->file->getSize());
        $this->file->seek($this->file->key() - $this->lines);
        return $this->readPage();
    }

    public function __destruct()
    {
        $this->file = null;
    }

}