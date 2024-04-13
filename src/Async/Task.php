<?php

namespace Async;

class Task {

    /**
     * 
     * @var Closure
     */
    private $fnExecution;

    /**
     * 
     * @return $this
     */
    public function __construct(\Closure $fnExecution) {
        $this->setFnExecution($fnExecution);
    }

    /**
     * 
     * @return  Closure
     */
    public function getFnExecution() {
        return $this->fnExecution;
    }

    /**
     * 
     * @return $this
     */
    public function setFnExecution(\Closure $fnExecution) {
        $this->fnExecution = $fnExecution;
        return $this;
    }

    public function call() {
        return call_user_func($this->getFnExecution());
    }

}