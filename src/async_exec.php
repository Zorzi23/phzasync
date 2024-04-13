<?php
spl_autoload_register(function($sClass) {
    require_once($sClass.'.php');
});
use Async\AsyncTaskRoute;
(new AsyncTaskRoute())->fetchProcesses();