<?php

require APPPATH.'libraries/spout/src/Spout/Autoloader/autoload.php';

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;
use Box\Spout\Common\Entity\Style\Border;
use Box\Spout\Writer\Common\Creator\Style\BorderBuilder;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Common\Entity\Style\CellAlignment;
use Box\Spout\Common\Entity\Style\Color;

class Excelib{
    private $writer;
    private $reader;
    //private $sheet;
    private $path;
    private $name;

    function __construct(){
        $this->writer = WriterEntityFactory::createXLSXWriter();
        //$this->path = BASEPATH.'../excel/';
        $this->path = 'project/temp/';
    }

    public function setFileReader($name){
        $this->reader = ReaderEntityFactory::createXLSXReader();
        $this->reader->open($this->path.$name);
        // print_r(get_class_methods($this->reader));
        // foreach($this->reader->getSheetIterator() as $sheet){
        //     echo $sheet->getName().PHP_EOL;
        //     // print_r(get_class_methods($sheet));
        // }
    }

    public function getSheetWriter($sheetName){
        foreach($this->reader->getSheetIterator() as $sheet){
            if($sheet->getName() == $sheetName){
                //$this->sheet = $sheet;
                return $sheet;
            }
        }
    }

    public function setNameFile($name){
        if(strstr($name,'/')){
            $dir = explode('/',$name);
            foreach ($dir as $key => $value) {
                if($key != count($dir)-1){
                    $this->path .= $value.'/';
                    if(!file_exists($this->path)) mkdir($this->path);
                }
                if($key == count($dir)-1) $this->name = $value;
            }
        }
        else $this->name = $name;
        $this->writer->openToFile($this->path.$this->name);
        //dumpvar($this->path.$this->name);
    }

    public function setHeaders($headers = []){
        $border = (new BorderBuilder())
			->setBorderBottom(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
			->setBorderLeft(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
			->setBorderRight(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
			->setBorderTop(Color::BLACK, Border::WIDTH_THIN, Border::STYLE_SOLID)
			->build();

		$style_heads = (new StyleBuilder())
			->setFontBold()
			->setShouldWrapText()
			->setFontColor(Color::WHITE)
			->setBackgroundColor(Color::DARK_BLUE)
			->setCellAlignment(CellAlignment::CENTER)
			->setBorder($border)
			->build();

		$style_content = (new StyleBuilder())
			->setBorder($border)
			->build();
        
        $cells = [];
        foreach($headers as $k => $v){
            $cells[] = WriterEntityFactory::createCell($v);
        }

		$singleRow = WriterEntityFactory::createRow($cells, $style_heads);
        $this->writer->addRow($singleRow);
    }
    
    public function setRow($row){
        $rowFromValues = WriterEntityFactory::createRowFromArray($row);
        $this->writer->addRow($rowFromValues);
    }

    public function close(){
        $this->writer->close();
        return $this->name;
    }
}