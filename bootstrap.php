<?php
define('VIEWS',__DIR__.'/src/Views');
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Controller\HomeController;
use App\Infrastructure\Routing\Router;
$router=new Router();
$router->addRoute('GET','/',[new HomeController(),'index']);

    

