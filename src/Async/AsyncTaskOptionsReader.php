<?php

namespace Async;

use FileReader\FileReaderStrategy,
    Async\AsyncTaskOptions;

class AsyncTaskOptionsReader implements FileReaderStrategy {

    public function read($sFilePath) {
        $sData = file_get_contents($sFilePath);
        $aConfig = json_decode($sData, true);
        $oOptions = new AsyncTaskOptions();
        if (isset($aConfig['ignoreUserAbort'])) {
            $oOptions->setIgnoreUserAbort($aConfig['ignoreUserAbort']);
        }
        if (isset($aConfig['maxExecutionTime'])) {
            $oOptions->setMaxExecutionTime($aConfig['maxExecutionTime']);
        }
        if (isset($aConfig['asyncEndpointDir'])) {
            $oOptions->setAsyncExecutionEndpoint($aConfig['asyncEndpointDir'] . 'async_exec.php');
        }

        return $oOptions;
    }

}