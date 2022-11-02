<?php

namespace App;

use App\Listener\Listener;
use Doctrine\Common\Annotations\AnnotationRegistry;
use JetBrains\PhpStorm\NoReturn;

require_once __DIR__ . '/../vendor/autoload.php';
define('ROOT_DIR', __DIR__ . '\\');

class Application
{
    public static function launch(): void
    {
        AnnotationRegistry::registerLoader('class_exists');
        $listener = new Listener();
        $listener->startListening();
    }
}

Application::launch();
