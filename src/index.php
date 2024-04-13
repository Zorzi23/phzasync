<?php
use Async\EnumExecutionType,
    Async\AsyncTask,
    Async\Task,
    Async\EnumPriorityTask;

$oTask = new Task(function() {
});

$oTaskAsync = new Task(function() {
    sleep(5);
});

$oAsyncTask = (new AsyncTask())
    ->addTask($oTaskAsync, EnumPriorityTask::HIGH_PRIORITY);

$oAsyncTask->getOptions()->setExecutionType(EnumExecutionType::ASYNC_BUFFER_REQUEST_EXECUTION);

$oAsyncTask->await();
$oTask->call();
