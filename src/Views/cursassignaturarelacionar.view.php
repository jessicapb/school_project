<?php
use App\Infrastructure\Database\DatabaseConnection;
$db = DatabaseConnection::getConnection();

use App\Infrastructure\Persistence\SubjectRepository;
$subjectrepo = new SubjectRepository($db);

use App\School\Services\SubjectServices;
$subjectservices = new SubjectServices($db, $subjectrepo);

$subjects = $subjectservices->show($subjectrepo);

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
    <title>Curs a Assignatura</title>
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
        <a id="localitzacio__enlac" href="/afegircurs">
            <p id="localitzacio__text--ubi">Curs a Assignatura</p>
        </a>
    </article>

    <form action="/addCourse" method="POST">
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
                        <label for="subject" id="titul">Assignatura:</label>
                        <select name="subject" id="subject">
                            <option value="" id="course__option">Selecciona una assignatura</option>
                            <?php foreach($subjects as $subject): ?>
                                <option value="<?php echo $subject->getId(); ?>" id="course__option"><?php echo $subject->getName(); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </section>
                
                <div class="boxbt">
                    <button id="boxbt__afegir">Assignar</button>
                </div>
        </div>
    </form>

    <!-- Footer -->
    <?php include 'parts/footer/footer.view.php'?>
</body>
</html>
