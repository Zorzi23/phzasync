<?php

namespace Async;

use FileReader\FileReaderStrategy,
    Async\AsyncTaskOptions;

class AsyncTaskOptionsReader implements FileReaderStrategy {

    public function read($sFilePath) {
        $sData = file_get_contents($sFilePath);
        $aConfig = json_decode($sData, true);
        $oOptions = new AsyncTaskOptions();
        if (isset($aConfig[$sPropertie = 'ignoreUserAbort'])) {
            $oOptions->setIgnoreUserAbort($aConfig[$sPropertie]);
        }
        if (isset($aConfig[$sPropertie = 'maxExecutionTime'])) {
            $oOptions->setMaxExecutionTime($aConfig[$sPropertie]);
        }
        if (isset($aConfig[$sPropertie = 'asyncEndpointDir'])) {
            $oOptions->setAsyncExecutionEndpointDir($aConfig[$sPropertie]);
        }
        if (isset($aConfig[$sPropertie = 'asyncExecProcessFile'])) {
            $oOptions->setAsyncExecutionProcessFile($aConfig[$sPropertie]);
        }
        if (isset($aConfig[$sPropertie = 'asyncEndpoint'])) {
            $oOptions->setAsyncExecutionEndpoint($aConfig[$sPropertie]);
        }
        if (isset($aConfig[$sPropertie = 'asyncLibDir'])) {
            $oOptions->setAsyncLibDir($aConfig[$sPropertie]);
        }
        return $oOptions;
    }

}