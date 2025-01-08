<?php
define('VIEWS',__DIR__.'/src/Views');
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Vistes
use App\Controller\HomeController;

use App\Controller\Nosaltres\NosaltresController;

use App\Controller\Alumne\AlumneAfegirController;
use App\Controller\Alumne\GuardarAlumneController;
use App\Controller\Alumne\VeureAlumneController;

use App\Controller\Assignatura\AssignaturaAfegirController;
use App\Controller\Assignatura\BDAssignaturaController;

use App\Controller\Curs\CursAfegirController;

use App\Controller\Departament\DepartamentAfegirController;
use App\Controller\Departament\BDDepartamentController;
use App\Controller\Departament\VeureDepartamentController;

use App\Controller\Examen\ExamenAfegirController;
use App\Controller\Examen\BDExamenController;
use App\Controller\Examen\VeureExamenController;

use App\Controller\Graus\GrausAfegirController;
use App\Controller\Graus\BDGrausController;
use App\Controller\Graus\VeureGrauController;

use App\Controller\Professor\ProfessorAfegirController;

// Repositoris
use App\Infrastructure\Persistence\StudentRepository;
use App\Infrastructure\Persistence\ExamRepository;
use App\Infrastructure\Persistence\DepartamentRepository;
use App\Infrastructure\Persistence\DegreesRepository;
use App\Infrastructure\Persistence\SubjectRepository;

//Rutas de les funcions
use App\Infrastructure\Routing\Router;

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
$services->addServices('departmentRepository', fn() => new DepartamentRepository($db));
$services->addServices('degreesRepository',fn() => new DegreesRepository($db));
$services->addServices('subjectRepository',fn() => new SubjectRepository($db));

$studentRepository = $services->getService('studentRepository');
$examRepository = $services->getService('examRepository');
$departmentRepository = $services->getService('departmentRepository');
$degreesRepository = $services->getService('degreesRepository');
$subjectRepository = $services->getService('subjectRepository');

$guardarAlumneController = new GuardarAlumneController($db);
$controllerexamen = new BDExamenController($db);
$controllerdepartment = new BDDepartamentController($db);
$controllergraus = new BDGrausController($db);
$controllerassignatura = new BDAssignaturaController($db);

// Rutes per veure les funcions
$router = new Router();
$router 
        // Obri la pàgina principal (index)
        ->addRoute('GET','/',[new HomeController(),'index'])

        // Porta a la pàgina del index
        ->addRoute('GET','/index',[new HomeController(),'index'])

        // Enllaç a afegir alumne
        ->addRoute('GET','/indexalumne',[new AlumneAfegirController(),'indexalumne'])

        //Enllaç a afegir professor
        ->addRoute('GET', '/indexprofessor', [new ProfessorAfegirController(), 'indexprofessor'])

        //Enllaç a afegir exàmens
        ->addRoute('GET','/indexexamen',[new ExamenAfegirController(),'indexexamen'])

        // Enllaç a afegir departament
        ->addRoute('GET','/indexdepartament',[new DepartamentAfegirController(),'indexdepartament'])

        // Enllaç a afegir graus
        ->addRoute('GET','/indexgraus',[new GrausAfegirController(),'indexgraus'])

        //Enllaç a afegir cursos
        ->addRoute('GET','/indexcurs',[new CursAfegirController(),'indexcurs'])

        // Enllaç a afegir assignatures
        ->addRoute('GET','/indexassignatura',[new AssignaturaAfegirController(),'indexassignatura'])

        //Guardar en la bd un departament o mostrar errors
        ->addRoute('POST', '/savedepartment', [$controllerdepartment, 'savedepartment'])

        // Enllaç a veure els departaments ficats
        ->addRoute('GET','/veuredepartament',[$controllerdepartment,'mostrarVista'])

        // Guardar en la bd un examen o mostrar errors
        ->addRoute('POST', '/saveexam', [$controllerexamen, 'saveexam'])

        // Enllaç a veure els exàmens ficats
        ->addRoute('GET', '/veureexamen', [$controllerexamen, 'mostrarVista'])

        // Guardar en la bd un alumne o mostrar errors
        ->addRoute('POST', '/savestudent', [$guardarAlumneController, 'savestudent'])

        // Enllaç a veure els alumnes ficats
        ->addRoute('GET', '/veurealumne', [$guardarAlumneController, 'mostrarVista'])

        // Guardar en la bd un grau o mostrar errors
        ->addRoute('POST','/savedegrees',[$controllergraus,'savedegrees'])

        // Enllaç a veure els graus ficats
        ->addRoute('GET','/veuregrau',[$controllergraus,'mostrarVista'])

        // Guardar en la bd una assignatura o mostrar errors
        ->addRoute('POST','/savesubject',[$controllerassignatura,'savesubject']);