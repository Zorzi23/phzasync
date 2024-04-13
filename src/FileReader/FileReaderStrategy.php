<?php

namespace FileReader;

interface FileReaderStrategy {
    public function read($sFilePath);
    
}