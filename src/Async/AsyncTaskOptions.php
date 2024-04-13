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
    private $iExecutionType = EnumExecutionType::ASYNC_BUFFER_EXECUTION;

    /**
     * 
     * @var string
     */
    private $sAsyncExecutionEndpoint;

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

}