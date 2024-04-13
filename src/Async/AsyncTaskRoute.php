<?php

namespace Async;

use Http\HttpConnection;

class AsyncTaskRoute {

    /**
     * 
     * @return void
     */
    public function fetchProcesses() {
        if(!self::getProcess()) {
            http_response_code(404);
            die;
        }
        if(self::getMaxExecutionTime()) {
            ini_set('max_execution_time', self::getMaxExecutionTime());
        }
        HttpConnection::closeConnection();
        HttpConnection::flush();
        require_once($sProcess = self::getProcess());
        unlink($sProcess);
    }
    
    /**
     * 
     * @return string|null
     */
    private static function getProcess() {
        return isset($_POST['process']) ? $_POST['process'] : null;
    }

    /**
     * 
     * @return int|null
     */
    private static function getMaxExecutionTime() {
        return isset($_POST['max_execution_time']) ? intval($_POST['max_execution_time']) : null;
    }

}