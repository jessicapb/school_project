<?php
define('VIEWS',__DIR__.'/src/Views');
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Controller\HomeController;
use App\Controller\Alumne\AlumneAfegirController;
use App\Infrastructure\Routing\Router;
$router=new Router();
$router 
        // Obri la pàgina principal (home)
        ->addRoute('GET','/index',[new HomeController(),'index'])
        // Enllaç alumne porti al formulari alumne
        -> addRoute('GET','/indexalumne',[new AlumneAfegirController(), 'indexalumne']);


