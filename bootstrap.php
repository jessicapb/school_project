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
use App\Controller\Assignatura\VeureAssignaturaController;

use App\Controller\Curs\CursAfegirController;
use App\Controller\Curs\BDCursController;
use App\Controller\Curs\VeureCursController;

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
use App\Controller\Professor\BDTeacherController;
use App\Controller\Professor\VeureProfessorController;

use App\Controller\Curs_Assignatura\CursAssignaturaController;
use App\Controller\Curs_Assignatura\AssignarCursAssignaturaBDController;

use App\Controller\Curs_Alumne\CursAlumneController;
use App\Controller\Curs_Alumne\CursAlumneBDController;

use App\Controller\Professor_Departament\ProfessorDepartamentController;
use App\Controller\Professor_Departament\ProfessorDepartamentBDController;

use App\Controller\Curs_Grau\CursGrauController;
use App\Controller\Curs_Grau\CursGrauAssignarBDController;

// Repositoris
use App\Infrastructure\Persistence\UserRepository;
use App\Infrastructure\Persistence\StudentRepository;
use App\Infrastructure\Persistence\ExamRepository;
use App\Infrastructure\Persistence\DepartamentRepository;
use App\Infrastructure\Persistence\DegreesRepository;
use App\Infrastructure\Persistence\SubjectRepository;
use App\Infrastructure\Persistence\CourseRepository;
use App\Infrastructure\Persistence\EnrollmentRepository;
use App\Infrastructure\Persistence\TeacherRepository;

//Rutes de les funcions
use App\Infrastructure\Routing\Router;

// Connexió base de dades
use App\Infrastructure\Database\DatabaseConnection;

// Serveis
use App\School\Services\Services;
use App\School\Services\StudentServices;
use App\School\Services\UserServices;
use App\School\Services\CourseServices;
use App\School\Services\SubjectServices;
use App\School\Services\EnrollmentServices;
use App\School\Services\DepartamentServices;
use App\School\Services\TeacherServices;
use App\School\Services\DegreesServices;

// Servei i connexió a la bd
$db=DatabaseConnection::getConnection();
$services=new Services();
$services->addServices('db',fn()=>$db);
$db=$services->getService('db');

//Repositori
$services->addServices('userRepository', fn() => new UserRepository($db));
$services->addServices('studentRepository', fn() => new StudentRepository($db));
$services->addServices('examRepository', fn() => new ExamRepository($db));
$services->addServices('departmentRepository', fn() => new DepartamentRepository($db));
$services->addServices('degreesRepository',fn() => new DegreesRepository($db));
$services->addServices('subjectRepository',fn() => new SubjectRepository($db));
$services->addServices('courseRepository',fn() => new CourseRepository($db));
$services->addServices('enrollmentRepository',fn() => new EnrollmentRepository($db));
$services->addServices('teacherRepository',fn() => new TeacherRepository($db));


$studentRepository = $services->getService('userRepository');
$studentRepository = $services->getService('studentRepository');
$examRepository = $services->getService('examRepository');
$departmentRepository = $services->getService('departmentRepository');
$degreesRepository = $services->getService('degreesRepository');
$subjectRepository = $services->getService('subjectRepository');
$courseRepository = $services->getService('courseRepository');
$enrollmentRepository = $services->getService('enrollmentRepository');
$teacherRepository = $services->getService('teacherRepository');

//Serveis
$services->addServices('studentServices', fn() => new StudentServices($db, $services->getService('studentRepository')));
$services->addServices('userServices', fn() => new UserServices($db, $services->getService('userRepository')));
$services->addServices('courseServices', fn() => new CourseServices($db, $services->getService('courseRepository')));
$services->addServices('subjectServices', fn() => new SubjectServices($db, $services->getService('subjectRepository')));
$services->addServices('enrollmentServices', fn() => new EnrollmentServices($db, $services->getService('enrollmentRepository')));
$services->addServices('departmentServices', fn() => new DepartamentServices($db, $services->getService('departmentRepository')));
$services->addServices('teacherServices', fn() => new TeacherServices($db, $services->getService('teacherRepository')));
$services->addServices('degreesServices', fn() => new DegreesServices($db, $services->getService('degreesRepository')));

$studentServices = $services->getService('studentServices');
$userServices = $services->getService('userServices');
$courseServices = $services->getService('courseServices');
$subjectServices = $services->getService('subjectServices');
$enrollmentServices = $services->getService('enrollmentRepository');
$departmentServices = $services->getService('departmentServices');
$teacherServices = $services->getService('teacherServices');
$degreesServices = $services->getService('degreesServices');

$guardarAlumneController = new GuardarAlumneController($db);
$controllerexamen = new BDExamenController($db);
$controllerdepartment = new BDDepartamentController($db);
$controllergraus = new BDGrausController($db);
$controllerassignatura = new BDAssignaturaController($db);
$controllercurs = new BDCursController($db);
$controllerprofessor = new BDTeacherController($db);
$veureAlumneController = new VeureAlumneController($studentServices);
$veureDepartmentController = new VeureDepartamentController($departmentServices);
$veureCursController = new VeureCursController($courseServices);
$veureAssignaturaController = new VeureAssignaturaController($subjectServices);
$veureProfessorController = new VeureProfessorController($teacherServices);
$veureGrauController = new VeureGrauController($degreesServices);
$cursassignaturacontroller = new CursAssignaturaController();
$AssignarCursAssignatura = new AssignarCursAssignaturaBDController($db);
$cursgraucontroller = new CursGrauController();
$AssignarCursGrau= new CursGrauAssignarBDController($db);
$AssignarCursAlumne = new CursAlumneBDController($db);
$professordepartamentcontroler = new ProfessorDepartamentController();
$AssignarProfessorDepartment = new ProfessorDepartamentBDController($db);

// Rutes per veure les funcions
$router = new Router();
$router 
        // Obri la pàgina principal (index)
        ->addRoute('GET','/',[new HomeController(),'index'])

        // Porta a la pàgina del index
        ->addRoute('GET','/index',[new HomeController(),'index'])

        // Enllaç a la pàgina nosaltres
        ->addRoute('GET','/indexnosaltres',[new NosaltresController(),'indexnosaltres'])

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
        ->addRoute('GET','/veuredepartament',[$veureDepartmentController,'veuredepartament'])

        // Guardar en la bd un examen o mostrar errors
        ->addRoute('POST', '/saveexam', [$controllerexamen, 'saveexam'])

        // Enllaç a veure els exàmens ficats
        ->addRoute('GET', '/veureexamen', [$controllerexamen, 'mostrarVista'])

        // Guardar en la bd un alumne o mostrar errors
        ->addRoute('POST', '/savestudent', [$guardarAlumneController, 'savestudent'])

        // Enllaç a veure els alumnes ficats
        ->addRoute('GET', '/veurealumne', [$veureAlumneController, 'veurealumne'])

        // Guardar en la bd un grau o mostrar errors
        ->addRoute('POST','/savedegrees',[$controllergraus,'savedegrees'])

        // Enllaç a veure els graus ficats
        ->addRoute('GET','/veuregrau',[$veureGrauController,'veuregrau'])

        // Guardar en la bd una assignatura o mostrar errors
        ->addRoute('POST','/savesubject',[$controllerassignatura,'savesubject'])
        
        // Enllaç a veure les assignatures ficades
        ->addRoute('GET','/veureassignatura',[$veureAssignaturaController,'veureassignatura'])

        //Guardar en la bd un curs o mostrar errors
        ->addRoute('POST','/savecourse',[$controllercurs,'savecourse'])
        
        //Guardar en la bd un professor o mostrar errors
        ->addRoute('POST','/saveteacher',[$controllerprofessor,'saveteacher'])

        // Enllaç a veure els professors ficats
        ->addRoute('GET','/veureprofessor',[$veureProfessorController,'veureprofessor'])

        // Enllaç a veure els cursos ficats
        ->addRoute('GET','/veurecurs',[$veureCursController,'veurecurs'])

        //Mostrar vista relacionar curs amb assignatura
        ->addRoute('GET', '/afegircurs', [new CursAssignaturaController(), 'indexcursassignatura'])
        
        //Relacionar assignatura amb un curs
        ->addRoute('POST','/addCourse',[$AssignarCursAssignatura,'addCourse'])
        
        //Mostrar vista relacionar curs amb alumne
        ->addRoute('GET', '/indexcursalumne', [new CursAlumneController(), 'indexcursalumne'])
        
        //Relacionar alumne amb un curs
        ->addRoute('POST','/addEnrollment',[$AssignarCursAlumne, 'addEnrollment'])
        
        //Mostrar vista relacionar professor amb departament
        ->addRoute('GET', '/indexprofessordepartament', [new ProfessorDepartamentController(), 'indexprofessordepartament'])
        
        //Relacionar professor amb un departament
        ->addRoute('POST','/addTeacher',[$AssignarProfessorDepartment, 'addTeacher'])
        
        //Mostrar vista relacionar curs amb grau
        ->addRoute('GET', '/indexcursgrau', [new CursGraucontroller(), 'indexcursgrau'])
        
        //Relacionar curs amb un grau
        ->addRoute('POST','/addSubject',[$AssignarCursGrau, 'addSubject']);

