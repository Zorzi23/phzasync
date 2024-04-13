<?php

namespace Serializer\Closure;

class ClosureAbstractor {

    /**
     * 
     * @var Closure
     */
    private $fnClosure;

    public function __construct(\Closure $fnClosure) {
        $this->setFnClosure($fnClosure);
    }

    /**
     * 
     * @return Closure
     */
    public function getClosure() {
        return $this->fnClosure;
    }

    /**
     * 
     * @param Closure $fnClosure
     * @return $this
     */
    public function setFnClosure(\Closure $fnClosure) {
        $this->fnClosure = $fnClosure;
        return $this;
    }
    

}