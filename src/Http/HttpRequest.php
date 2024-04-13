<?php

namespace Http;

class HttpRequest {

    /**
     * 
     * @var string
     */
    private $sUrl;

    /**
     * 
     * @return string
     */
    private $sMethod;

    /**
     * 
     * HttpHeader[]
     */
    private $aHeaders = [];

    /**
     * 
     * @var mixed[]
     */
    private $aData = [];

    /**
     * 
     * @var int
     */
    private $iTimeout = null;

    /**
     * 
     * @param string $sUrl
     * @param string $sMethod
     * @return $this
     */
    public function __construct($sUrl, $sMethod) {
        $this->setUrl($sUrl)->setMethod($sMethod);
    }

    /**
     *
     * @return string
     */
    public function getUrl() {
        return $this->sUrl;
    }

    /**
     *
     * @throws \Exception
     * @param string $sUrl
     * @return $this
     */
    public function setUrl($sUrl) {
        if (!filter_var($sUrl, FILTER_VALIDATE_URL)) {
            throw new \Exception("Malformed URL: $sUrl");
        }
        $this->sUrl = $sUrl;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getMethod() {
        return $this->sMethod;
    }

    /**
     *
     * @param string $sMethod
     * @return $this
     */
    public function setMethod($sMethod) {
        $this->sMethod = $sMethod;
        return $this;
    }

    /**
     *
     * @return HttpHeader[]
     */
    public function getHeaders() {
        return $this->aHeaders;
    }

    /**
     *
     * @return string[]
     */
    public function getTreatedHeaders() {
        return array_map(function($oHeader) {
            return $oHeader->getHeader();
        }, $this->aHeaders);
    }

    /**
     *
     * @param HttpHeader[] $aHeaders
     * @return $this
     */
    public function setHeaders($aHeaders) {
        foreach($aHeaders as $oHeader) {
            $this->addHeader($oHeader);
        }
        return $this;
    }

    /**
     *
     * @param HttpHeader $oHeader
     * @return $this
     */
    public function addHeader(HttpHeader $oHeader) {
        $this->aHeaders[] = $oHeader;
        return $this;
    }

    /**
     *
     * @return mixed[]
     */
    public function getData() {
        return $this->aData;
    }

    /**
     * 
     * @param mixed[] $aData
     * @return $this
     */
    public function setData($aData) {
        foreach($aData as $sKey => $xData) {
            $this->addData($xData, $sKey);
        }
        return $this;
    }

    /**
     * 
     * @param mixed $xData
     * @return $this
     */
    public function addData($xData, $sKey = null) {
        if($sKey) {
            $this->aData[$sKey] = $xData;
            return $this;
        }
        $this->aData[] = $xData;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getTimeout() {
        return $this->iTimeout;
    }

    /**
     * 
     * @param int
     * @return $this
     */
    public function setTimeout($iTimeout) {
        $this->iTimeout = $iTimeout;
        return $this;
    }

    /**
     * 
     * @throws \Exception
     * @return string|false
     */
    public function fetch() {
        $oHandle = curl_init();
        curl_setopt($oHandle, CURLOPT_URL, $this->getUrl());
        curl_setopt($oHandle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($oHandle, CURLOPT_CUSTOMREQUEST, $this->getMethod());
        curl_setopt($oHandle, CURLOPT_FORBID_REUSE, true);
        if(is_null($this->getTimeout())) {
            curl_setopt($oHandle, CURLOPT_TIMEOUT, $this->getTimeout());
        }
        if($this->getMethod() === 'POST') {
            curl_setopt($oHandle, CURLOPT_POSTFIELDS, $this->getData());
        }
        if($this->getHeaders()) {
            curl_setopt($oHandle, CURLOPT_HTTPHEADER, $this->getTreatedHeaders());
        }
        $xResponse = curl_exec($oHandle);
        if (curl_errno($oHandle)) {
            throw new \Exception(curl_error($oHandle));
        }
        curl_close($oHandle);
        return $xResponse;
    }

}