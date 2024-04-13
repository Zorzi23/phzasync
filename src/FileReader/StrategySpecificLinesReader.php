<?php

namespace FileReader;

use FileReader\FileReaderStrategy;

class StrategySpecificLinesReader implements FileReaderStrategy {

    /**
     * 
     * @var int
     */
    private $iStartLine;

    /**
     * 
     * @var int
     */
    private $iEndLine;

    /**
     * 
     * @return $this
     */
    public function __construct($iStartLine, $iEndLine) {
        $this->setStartLine($iStartLine)->setEndLine($iEndLine);
    }

    /**
     * 
     * @return int
     */
    public function getStartLine() {
        return $this->iStartLine;
    }

    /**
     * 
     * @return $this
     */
    public function setStartLine($iStartLine) {
        $this->iStartLine = $iStartLine;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getEndLine() {
        return $this->iEndLine;
    }

    /**
     * 
     * @return $this
     */
    public function setEndLine($iEndLine) {
        $this->iEndLine = $iEndLine;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function read($sFilePath) {
        $aLines = [];
        foreach($this->generativeRead($sFilePath) as $sLine) {
            $aLines[] = $sLine;
        }
        return implode(PHP_EOL, $aLines);
    }

    private function generativeRead($sFilePath) {
        $iCurrentLine = 1;
        $rFile = fopen($sFilePath, "r");
        if(!$rFile) {
            throw new \Exception("Cannot open file.");
        }
        while (!feof($rFile) && $iCurrentLine <= $this->getEndLine()) {
            $sLine = fgets($rFile);
            if ($iCurrentLine >= $this->getStartLine()) {
                yield $sLine;
            }
            $iCurrentLine++;
        }
        fclose($rFile);
    }

}