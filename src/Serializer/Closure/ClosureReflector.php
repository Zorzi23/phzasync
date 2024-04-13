<?php

namespace Serializer\Closure;

use ReflectionFunction,
    FileReader\FileReader,
    FileReader\StrategySpecificLinesReader,
    UnexpectedValueException;

class ClosureReflector extends ReflectionFunction {

    /**
     * 
     * @var Closure $fnClosure
     */
    public function __construct(\Closure $fnClosure) {
        parent::__construct($fnClosure);
    }

    /**
     * 
     * @throws UnexpectedValueException
     * @return string
     */
    public function getCode() {
        preg_match(
            self::getCodePattern(),
            $this->getBruteCode(),
            $aMatches
        );
        if(!count($aMatches)) {
            throw new UnexpectedValueException('The code body is null');
        }
        return trim($aMatches[0]);
    }
    
    public function getCodeFunctionDefintion() {
        preg_match(
            $this->isArrowFunction() ? self::getArrayFunctionCodeFunctionDefinitionPattern() : self::getCodeFunctionDefinitionPattern(),
            $this->getBruteCode(),
            $aMatches
        );
        if(!count($aMatches)) {
            throw new UnexpectedValueException('The code function definition is null');
        }
        return trim($aMatches[0]);
    }

    /**
     * 
     * @return string
     */
    public function getBruteCode() {
        return $this->getFunctionReader()->read();
    }

    /**
     * 
     * @return FileReader;
     */
    private function getFunctionReader() {
        return new FileReader(
            $this->getFileName(),
            $this->getFunctionReaderStrategy()
        );
    }

    /**
     * 
     * @return StrategySpecificLinesReader
     */
    private function getFunctionReaderStrategy() {
        return new StrategySpecificLinesReader($this->getStartLine(), $this->getEndLine());
    }

    /**
     * @return string[]
     */
    protected function getFileTokens() {
        return token_get_all(file_get_contents($this->getFileName()));
    }

    /**
     * 
     * @return bool
     */
    public function isArrowFunction() {
        return boolval(preg_match(
            self::getArrayFunctionCodeFunctionDefinitionPattern(),
            $this->getBruteCode(),
            $aMatches
        ));
    }

    /**
     * 
     * @return string
     */

    protected static function getCodePattern() {
        return '/(?<=\{).+(?=\})/s';
    }

    /**
     * 
     * @return string
     */
    protected static function getArrayFunctionCodeFunctionDefinitionPattern() {
        $sVariablePattern = self::getPHPVariablePattern();
        return "/(fn(\s)*\({$sVariablePattern}\)+(\s)*\=>).*(?=\;)/s";
    }

    /**
     * 
     * @return string
     */
    protected static function getCodeFunctionDefinitionPattern() {
        $sVariablePattern = self::getPHPVariablePattern();
        return "/(function(\s)*\({$sVariablePattern}\))+.+(?<=(\}|\;|\s))/s";
    }

    /**
     * 
     * @return string
     */
    protected static function getPHPVariablePattern() {
        return '.*';
    }

}