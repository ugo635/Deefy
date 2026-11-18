<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use iutnc\deefy\dispatch\Dispatcher;

$dispatcher = new Dispatcher();
$dispatcher->run();