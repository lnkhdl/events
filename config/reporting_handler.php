<?php

function customHandler($e) {
    logToFile($e);

    if (ini_get('display_errors')) {
        $log = "<b>Time: </b><br>" . date('Y-m-d H:i:s e');
        $log .= "<br><br><b>Code: </b><br>" . $e->getCode();
        $log .= "<br><br><b>Message: </b><br>" . $e->getMessage();
        $log .= "<br><br><b>File: </b><br>" . $e->getFile();
        $log .= "<br><br><b>File Line: </b><br>" . $e->getLine();
        $log .= "<br><br><b>Trace: </b><br>" . nl2br($e->getTraceAsString());
        echo $log;
    } else {
        header('Location: /error500');
    }
}

function logToFile($e) {
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

set_exception_handler('customHandler');

set_error_handler(function ($level, $message, $file = '', $line = 0) {
    throw new ErrorException($message, 0, $level, $file, $line);
});

register_shutdown_function(function () {
    $error = error_get_last();
    if ($error !== null) {
        $e = new ErrorException($error['message'], 0, $error['type'], $error['file'], $error['line']);
        customHandler($e);
    }
});