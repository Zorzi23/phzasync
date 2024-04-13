<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Async\Task;
use Async\AsyncTask;
use Async\EnumPriorityTask;
use Async\EnumExecutionType;

class AsyncTaskTest extends TestCase {
    public function testAsyncTask() {
        $oTask = new Task(function () {
            echo 'Sync Task start.';
        });
        $oTaskAsync = new Task(function () {
            echo 'Async Task start.';
            sleep(5);
            echo 'Async Task end.';
        });
        $oAsyncTask = (new AsyncTask())
            ->addTask($oTaskAsync, EnumPriorityTask::HIGH_PRIORITY);
        $oAsyncTask->getOptions()->setExecutionType(EnumExecutionType::ASYNC_BUFFER_REQUEST_EXECUTION);
        $oAsyncTask->await();
        $oTask->call();
        $this->assertTrue(true);
    }
}
