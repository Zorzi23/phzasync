<?php

namespace FileReader;

interface FileReaderStrategy {

    /**
     * 
     * @return mixed
     */
    public function read($sFilePath);
    
}