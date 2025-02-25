<?php
use App\Infrastructure\Database\DatabaseConnection;
$db = DatabaseConnection::getConnection();

use App\Infrastructure\Persistence\StudentRepository;
$studentrepo = new StudentRepository($db);

use App\School\Services\StudentServices;
$studentservices = new StudentServices($db, $studentrepo);

$students = $studentservices->show($studentrepo);

use App\Infrastructure\Persistence\CourseRepository;
$courserepo = new CourseRepository($db);

use App\School\Services\CourseServices;
$courseservices = new CourseServices($db, $courserepo);

$courses = $courseservices->show($courserepo);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curs a Alumne</title>
    <link rel="stylesheet" href="css/assignarform/assignarform.css">
    <link rel="icon" href="img/iconacole.png" type="image/x-icon">
</head>
<body>

    <!-- Navegación -->
    <?php include 'parts/nav/nav.view.php'?>

    <!-- Localización -->
    <article class="localitzacio">
        <a id="localitzacio__enlac" href="/index">
            <p id="localitzacio__text">INICI</p>
        </a>
        <img id="localitzacio__img" src="img/fletxes/fletxadreta.png" alt="fletxadreta">
        <a id="localitzacio__enlac" href="/indexcursalumne">
            <p id="localitzacio__text--ubi">Alumne a Curs</p>
        </a>
    </article>

    <form action="/addEnrollment" method="POST">
        <div id="box">
            <section id="capsa__individual">
                <div>
                    <label for="course" id="titul">Curs:</label>
                    <select name="course" id="course">
                        <option value="" id="course__option">Selecciona el curs</option>
                        <?php foreach($courses as $course): ?>
                            <option value="<?php echo $course->getId(); ?>" id="course__option"><?php echo $course->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </section>

            <section id="capsa__individual">
                <div>
                    <label for="course" id="titul">Alumne:</label>
                    <select name="student" id="student">
                        <option value="" id="course__option">Selecciona un alumne</option>
                        <?php foreach($students as $student): ?>
                            <option value="<?php echo $student->getId(); ?>" id="course__option"><?php echo $student->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </section>
            
            <div class="boxbt">
                <button id="boxbt__afegir">Assignar</button>
            </div>
        </div>
    </form>

    <!-- Fletxa dalt -->
    <?php include 'parts/fletxadalt/fletxadalt.view.php'?>

    <!-- Footer -->
    <?php include 'parts/footer/footer.view.php'?>

</body>
</html>
