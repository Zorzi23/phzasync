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
     * @var \FileReader\IFileReaderStrategy
     */
    private $oStrategy;

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

    public function setStrategy($oStrategy) {
        $this->oStrategy = $oStrategy;
        return $this;
    }

    public function read() {
        return $this->oStrategy->read($this->getFilePath());
    }

}

