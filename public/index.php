<?php

use Illuminate\Http\Request;

// Captura el momento en que se inicia la aplicación (mide el tiempo de ejecución de la aplicación)
define('LARAVEL_START', microtime(true));

// Si existe un archivo de mantenimiento (maintenance.php) significa que la aplicación está en modo de mantenimiento (actualización)
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// El autoload.php es un gestor de dependencias para PHP y permite que la aplicación cargue automáticamente las clases y bibliotecas necesarias sin tener que incluirlas manualmente
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__ . '/../bootstrap/app.php')
    // Captura la solicitud HTTP que se ha enviado a la aplicación.
    ->handleRequest(Request::capture());
