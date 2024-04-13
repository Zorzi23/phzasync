<?php

namespace Http;

class HttpHeader {

    /**
     * 
     * @var string
     */
    private $sName;

    /**
     * 
     * @var mixed[]
     */
    private $aValues = [];

    /**
     * 
     * @param string $sName
     * @param mixed[] $aValues
     * @return $this
     */
    public function __construct($sName, $aValues = []) {
        $this->setName($sName);
        $this->setValues($aValues);
    }

    /**
     * 
     * @return string
     */
    public function getName() {
        return $this->sName;
    }

    /**
     * 
     * @param string $sName
     * @return $this
     */
    public function setName($sName) {
        $this->sName = $sName;
        return $this;
    }

    /**
     * 
     * @return mixed[]
     */
    public function getValues() {
        return $this->aValues;
    }

    /**
     * 
     * @var mixed[] $aValus
     * @return $this
     */
    public function setValues($aValues) {
        foreach($aValues as $sValue) {
            $this->addValue($sValue);
        }
        return $this;
    }

    /**
     * 
     * @param string $sValue
     * @return $this
     */
    public function addValue($sValue) {
        $this->aValues[] = $sValue;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getHeader() {
        return sprintf(
            '%s:%s',
            $this->getName(),
            implode(',', $this->getValues())
        );
    }

}
