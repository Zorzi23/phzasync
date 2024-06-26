<?php

namespace FileReader;

class FileReader {

    /**
     * 
     * @var string
     */
    private $sFilePath;

    /**
     * 
     * @var FileReaderStrategy
     */
    private $oStrategy;

    /**
     * 
     * @param string $sFilePath
     * @param FileReaderStrategy $oStrategy
     */
    public function __construct($sFilePath, $oStrategy) {
        $this->setFilePath($sFilePath)->setStrategy($oStrategy);
    }
    
    /**
     * 
     * @return string
     */
    public function getFilePath() {
        return $this->sFilePath;
    }

    /**
     * 
     * @param string $sFilePath
     * @return $this  
     */
    public function setFilePath($sFilePath) {
        $this->sFilePath = $sFilePath;
        return $this;
    }

    /**
     * 
     * @return $this
     */
    public function setStrategy($oStrategy) {
        $this->oStrategy = $oStrategy;
        return $this;
    }

    /**
     * 
     * @return mixed
     */
    public function read() {
        return $this->oStrategy->read($this->getFilePath());
    }

}

