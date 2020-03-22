<?php
namespace CaoMinhDuc\ExcelTemplate;

use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeWriting;
use Maatwebsite\Excel\Files\LocalTemporaryFile;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;

class ExcelResponse implements WithEvents
{
    use Exportable, RegistersEventListeners;

    public $template = NULL;

    public $data = [];

    public $customCells = [];

    public $startCell = 'A1';
    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            BeforeWriting::class => function (BeforeWriting $event)
            {
                if(empty($this->template))
                {
                    return;
                }
                $event->writer->reopen(
                    new LocalTemporaryFile(
                        Storage::path($this->template)
                    ),
                    Excel::XLSX
                );
        
                $sheet = $event->writer->getSheetByIndex(0);
        
                
                foreach($event->getConcernable()->customCells() as $location => $value)
                {
                    $sheet->getDelegate()->getCell($location)->setValue($value);
                }
                

                $fromArray = $event->getConcernable()->array();
                $startCell = $event->getConcernable()->startCell();
                $sheet->getDelegate()->fromArray(
                    $fromArray,
                    NULL,
                    $startCell
                );
            },
        ];
    }

    public function array(): array
    {   
        return $this->getData();
    }

    public function startCell(): string
    {
        return $this->getStartCell();
    }

    public function customCells(): array
    {
        return $this->getCustomCells();
    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get the value of customCells
     */ 
    public function getCustomCells()
    {
        return $this->customCells;
    }

    /**
     * Set the value of customCells
     *
     * @return  self
     */ 
    public function setCustomCells($customCells)
    {
        $this->customCells = $customCells;

        return $this;
    }

    /**
     * Get the value of startCell
     */ 
    public function getStartCell()
    {
        return $this->startCell;
    }

    /**
     * Set the value of startCell
     *
     * @return  self
     */ 
    public function setStartCell($startCell)
    {
        $this->startCell = $startCell;

        return $this;
    }

    /**
     * Get the value of template
     */ 
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * Set the value of template
     *
     * @return  self
     */ 
    public function setTemplate($template)
    {
        $this->template = $template;

        return $this;
    }
}