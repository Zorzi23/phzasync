<?php

namespace Async;

use Serializer\Closure\ClosureReflector,
    Async\EnumExecutionType,
    Async\Task,
    Async\AsyncTaskOptionsReader,
    Async\AsyncTaskOptions,
    Http\HttpConnection,
    Http\HttpRequest;


class AsyncTask {

    /**
     * 
     * @var \SplPriorityQueue 
     */
    private $oTasks;

    /**
     * 
     * @var AsyncTaskOptions
     */
    private $oOptions;

    /**
     * 
     * @param Task[] $aTasks
     */
    public function __construct($aTasks = [], AsyncTaskOptions $oOptions = null) {
        $this->setTasks($aTasks)->setOptions($oOptions ?: self::createDefaultOptions());
    }

    /**
     * 
     * @return \SplPriorityQueue
     */
    public function getTasks() {
        return $this->oTasks;
    }

    /**
     * 
     * @param Task[] $aTasks 
     * @return $this
     */
    public function setTasks($aTasks) {
        if(!$this->oTasks) {
            $this->oTasks = new \SplPriorityQueue();
        }
        foreach($aTasks as $iPriority => $oTask) {
            $this->addTask($oTask, $iPriority);
        }
        return $this;
    }

    /**
     * 
     * @param Task $oTask
     * @param int $iPriority
     * @return $this
     */
    public function addTask(Task $oTask, $iPriority) {
        $this->oTasks->insert($oTask, $iPriority);
        return $this;
    }

    /**
     * 
     * @var AsyncTaskOptions $oOptions
     * @return $this
     */
    public function setOptions(AsyncTaskOptions $oOptions) {
        $this->oOptions = $oOptions;
        return $this;
    }

    /**
     * 
     * @return AsyncTaskOptions
     */
    public function getOptions() {
        return $this->oOptions;
    }

    /**
     * 
     * @return $this
     */
    public function await() {
        switch($this->getOptions()->getExecutionType()) {
            case EnumExecutionType::ASYNC_BUFFER_REQUEST_EXECUTION:
                $this->awaitRequestExecutionBuffer();
                break;
            default:
                $this->awaitExecutionBuffer();
                break;
        }
        return $this;
    }

    private function awaitExecutionBuffer() {
        register_shutdown_function(function() {
            $this->executeAsyncBuffer();
        });
        return $this;
    }

    private function awaitRequestExecutionBuffer() {
        foreach($this->getTasks() as $oTask) {
            $sFileProcess = self::createExecutionFile($oTask);  
            file_put_contents('test.txt', $this->getOptions()->getAsyncExecutionEndpoint());
            $oRequest = new HttpRequest($this->getOptions()->getAsyncExecutionEndpoint(), 'POST');
            $oRequest->setTimeout(0);
            $oRequest->addData($sFileProcess, 'process');
            $oRequest->addData($this->getOptions()->getMaxExecutionTime(), 'max_execution_time');
            $oRequest->fetch();
        }
        return $this;
    }

    /**
     * 
     * @return $this
     */
    private function executeAsyncBuffer() {
        $this->start();
        foreach($this->getTasks() as $oTask) {
            ini_set('max_execution_time', $this->getOptions()->getMaxExecutionTime());
            $sExecutionFile = self::createExecutionFile($oTask);
            require_once($sExecutionFile);
            unlink($sExecutionFile);
        }
        return $this;
    }

    /**
     * 
     * @return $this;
     */
    private function start() {
        ignore_user_abort($this->getOptions()->isIgnoreUserAbort());
        HttpConnection::closeConnection();
        HttpConnection::flush();
        return $this;
    }

    /**
     * 
     * @return string
     */
    private static function createExecutionFile(Task $oTask, $sExtension = 'php') {
        $sFile = self::createExecutionFilePath(sys_get_temp_dir(), $sExtension);
        file_put_contents($sFile, self::createExecutionContent($oTask));
        return $sFile;
    }

    /**
     * 
     * @return string
     */
    private static function createExecutionFilePath($sDir = null, $sExtension = 'php') {
        return sprintf("%s\%s.{$sExtension}", $sDir, self::createExecutionId());
    }
    
    /**
     * 
     * @return string
     */
    private static function createExecutionContent(Task $oTask) {
        return sprintf(
            '<?php call_user_func(function() { %s });',
            self::createClosureReflectorTask($oTask)->getCode()
        );
    }

    /**
     * 
     * @return ClosureReflector
     */
    private static function createClosureReflectorTask(Task $oTask) {
        return new ClosureReflector($oTask->getFnExecution());
    }

    /**
     * 
     * @return string
     */
    private static function createExecutionId() {
        return hash('sha512', sprintf('%s$%s$', uniqid(), uniqid()));
    }

    /**
     * 
     * @return AsyncTaskOptions
     */
    private static function createDefaultOptions() {
        return (new AsyncTaskOptionsReader())->read(dirname(__DIR__).'\config\config.json');
    }

}
