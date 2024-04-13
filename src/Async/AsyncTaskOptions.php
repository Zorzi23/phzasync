<?php

namespace Async;

class AsyncTaskOptions {

    /**
     * 
     * @var bool
     */
    private $bIgnoreUserAbort = false;

    /**
     * 
     * @var int
     */
    private $iMaxExecutionTime = 30;

    /**
     * 
     * @var int
     */
    private $iExecutionType = EnumExecutionType::ASYNC_BUFFER_REQUEST_EXECUTION;

    /**
     * 
     * @var string
     */
    private $sAsyncExecutionEndpoint;

    /**
     * 
     * @var string
     */
    private $sAsyncExecutionEndpointDir;

    /**
     * 
     * @var string
     */
    private $sAsyncLibDir;

    /**
     * 
     * @var string
     */
    private $sAsyncExecutionProcessFile;

    /**
     * 
     * @param bool $bIgnoreUserAbort
     */
    public function setIgnoreUserAbort($bIgnoreUserAbort) {
        $this->bIgnoreUserAbort = $bIgnoreUserAbort;
        return $this;
    }

    /**
     * 
     * @return bool
     */
    public function isIgnoreUserAbort() {
        return $this->bIgnoreUserAbort;
    }

    /**
     * 
     * @return $this
     */
    public function setMaxExecutionTime($iMaxExecutionTime) {
        $this->iMaxExecutionTime = $iMaxExecutionTime;
        return $this;
    }

    /**
     * 
     * @return int
     */
    public function getMaxExecutionTime() {
        return $this->iMaxExecutionTime;
    }

    /**
     * 
     * @return int
     */
    public function getExecutionType() {
        return $this->iExecutionType;
    }

    /**
     * 
     * @param int $iExecutionType
     * @return $this
     */
    public function setExecutionType($iExecutionType) {
        $this->iExecutionType = $iExecutionType;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getAsyncExecutionEndpoint() {
        return $this->sAsyncExecutionEndpoint;
    }

    /**
     *
     * @param string $sEndpoint
     * @return $this
     */
    public function setAsyncExecutionEndpoint($sEndpoint) {
        $this->sAsyncExecutionEndpoint = $sEndpoint;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getAsyncExecutionEndpointDir() {
        return $this->sAsyncExecutionEndpointDir;
    }

    /**
     *
     * @param string $sFile
     * @return $this
     */
    public function setAsyncExecutionEndpointDir($sDir) {
        $this->sAsyncExecutionEndpointDir = $sDir;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getAsyncExecutionProcessFile() {
        return $this->sAsyncExecutionProcessFile;
    }

    /**
     *
     * @param string $sFile
     * @return $this
     */
    public function setAsyncExecutionProcessFile($sFile) {
        $this->sAsyncExecutionProcessFile = $sFile;
        return $this;
    }

        /**
     *
     * @return string
     */
    public function getAsyncLibDir() {
        return $this->sAsyncLibDir;
    }

    /**
     *
     * @param string $sFile
     * @return $this
     */
    public function setAsyncLibDir($sDir) {
        $this->sAsyncLibDir = $sDir;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getFullPathAsyncExecutionProcessFile() {
        return $this->getAsyncExecutionEndpointDir().$this->getAsyncExecutionProcessFile();
    }

    /**
     *
     * @return string
     */
    public function getFullPathEndpointAsyncExecutionProcessFile() {
        return $this->getAsyncExecutionEndpoint().$this->getAsyncExecutionProcessFile();
    }

}