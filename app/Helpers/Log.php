<?php
namespace App\Helpers;

if (!function_exists('salvarLog')) {
    function salvarLog($mensagem)
    {
        $logFile = storage_path('logs/custom.log');
        $logMessage = "[" . date('Y-m-d H:i:s') . "] " . $mensagem . PHP_EOL;
        
        file_put_contents($logFile, $logMessage, FILE_APPEND);
    }
}
