<?php

function customHandler($e)
{
    logToFile($e);

    if (ini_get('display_errors')) {
        logToScreen($e);
    } else {
        $templatesFolder = substr($_SERVER['REQUEST_URI'], 0, 5) === "/api/" ? '/../src/Templates/api/errors/' : '/../src/Templates/web/errors/';
        if ($e->getCode() === 400) {
            http_response_code(400);
            include __DIR__ . $templatesFolder . '400.php';
        } elseif ($e->getCode() === 404) {
            http_response_code(404);
            include __DIR__ . $templatesFolder . '404.php';
        } else {
            http_response_code(500);
            include __DIR__ . $templatesFolder . '500.php';
        }
    }

    // Die because of Fatal error handling, e.g. require file that doesn't exist
    die();
}


function logToScreen($e)
{
    $log = "<b>Time: </b><br>" . date('Y-m-d H:i:s e');
    $log .= "<br><br><b>Code: </b><br>" . $e->getCode();
    $log .= "<br><br><b>Message: </b><br>" . $e->getMessage();
    $log .= "<br><br><b>File: </b><br>" . $e->getFile();
    $log .= "<br><br><b>File Line: </b><br>" . $e->getLine();
    $log .= "<br><br><b>Trace: </b><br>" . nl2br($e->getTraceAsString());
    echo $log;
}


function logToFile($e)
{
    $filePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . '_log' . DIRECTORY_SEPARATOR;
    $fileName = date('Y-m-d') . '.log';

    if (!file_exists($filePath)) {
        mkdir($filePath, 0777, true);
    }

    $fileMsg = "[" . date('Y-m-d H:i:s e') . "]\r\n";
    $fileMsg .= $e->getCode() . "\r\n";
    $fileMsg .= $e->getMessage() . "\r\n";
    $fileMsg .= $e->getFile() . ", line: " . $e->getLine() . "\r\n";
    $fileMsg .= $e->getTraceAsString() . "\r\n\r\n";

    error_log($fileMsg, 3, $filePath . $fileName);
}


function logError($level, $message, $file = '', $line = 0)
{
    customHandler(new ErrorException($message, 0, $level, $file, $line));
}


set_error_handler('logError');

set_exception_handler('customHandler');

register_shutdown_function(function () {
    $lastError = error_get_last();
    if ($lastError !== null) {
        $e = new ErrorException($lastError['message'], 0, $lastError['type'], $lastError['file'], $lastError['line']);
        customHandler($e);
    }
});