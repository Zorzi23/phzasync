<?php
if(!isset($_POST['process'])) {
    http_response_code(404);
    die;
}
spl_autoload_register(function($sClass) {
    require_once(sprintf('%s/%s.php', $_POST['background_execution_dir'], $sClass));
});
use Async\AsyncTaskRoute;
(new AsyncTaskRoute())->fetchProcesses(); 