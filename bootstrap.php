<?php
define('VIEWS',__DIR__.'/src/Views');
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Vistes
use App\Controller\HomeController;

use App\Controller\Alumne\AlumneAfegirController;
use App\Controller\Alumne\GuardarAlumneController;
use App\Controller\Alumne\VeureAlumneController;

use App\Controller\Examen\ExamenAfegirController;
use App\Controller\Examen\BDExamenController;
use App\Controller\Examen\VeureExamenController;

use App\Infrastructure\Routing\Router;

use App\Infrastructure\Persistence\StudentRepository;
use App\Infrastructure\Persistence\ExamRepository;

use App\Controller\Professor\ProfessorAfegirController;


// Veure les dades de la base de dades
use App\Controller\Alumne\VeureAlumneQueryController;

// Connexió base de dades
use App\Infrastructure\Database\DatabaseConnection;

// Serveis
use App\School\Services\Services;

// Servei i connexió a la bd
$db=DatabaseConnection::getConnection();
$services=new Services();
$services->addServices('db',fn()=>$db);
$db=$services->getService('db');

$services->addServices('studentRepository', fn() => new StudentRepository($db));
$services->addServices('examRepository', fn() => new ExamRepository($db));
$studentRepository = $services->getService('studentRepository');
$examRepository = $services->getService('examRepository');

$guardarAlumneController = new GuardarAlumneController($db, $studentRepository);
$controllerexamen = new BDExamenController($db);

$controller = new VeureAlumneQueryController();
$alumne = $controller->queryalumne($db);

// Rutes per veure les vistes
$router = new Router();
$router 
        // Obri la pàgina principal (home)
        ->addRoute('GET','/',[new HomeController(),'index'])

        // Enllaç a afegir alumne
        ->addRoute('GET','/indexalumne',[new AlumneAfegirController(),'indexalumne'])

        // Porta a la pàgina del index
        ->addRoute('GET','/index',[new HomeController(),'index'])

        // Enllaç a veureexamen
        ->addRoute('GET', '/veureexamen', [$controllerexamen, 'mostrarVista'])
        
        // Guardar en la bd o mostrar els errors en guardar un alumne
        ->addRoute('POST', '/savestudent', [$guardarAlumneController, 'savestudent'])

        // Guardar en la bd o mostrar els errors en guardar un examen
        ->addRoute('POST', '/saveexam', [$controllerexamen, 'saveexam'])

        // Enllaç a veure els alumnes
        ->addRoute('GET', '/veurealumne', [new VeureAlumneController(), 'veurealumne'])
        ->addRoute('GET', '/queryalumne', [new VeureAlumneQueryController(), 'queryalumne'])
        ->addRoute('GET', '/veurealumne', [new VeureAlumneQueryController(), 'queryalumne'])

        //Enllaç a afegir professor
        ->addRoute('GET', '/indexprofessor', [new ProfessorAfegirController(), 'indexprofessor'])
        
        //Enllaç a afegir exàmens
        ->addRoute('GET','/indexexamen',[new ExamenAfegirController(),'indexexamen']);