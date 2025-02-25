<?php
use App\Infrastructure\Database\DatabaseConnection;
$db = DatabaseConnection::getConnection();

use App\Infrastructure\Persistence\DepartamentRepository;
$departamentrepo = new DepartamentRepository($db);

use App\School\Services\DepartamentServices;
$departamentservices = new DepartamentServices($db, $departamentrepo);

$departaments = $departamentservices->show($departamentrepo);

use App\Infrastructure\Persistence\TeacherRepository;
$teacherrepo = new TeacherRepository($db);

use App\School\Services\TeacherServices;
$teacherservices = new TeacherServices($db, $teacherrepo);

$teachers = $teacherservices->show($teacherrepo);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professor a Departament<</title>
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
        <a id="localitzacio__enlac" href="/indexprofessordepartament">
            <p id="localitzacio__text--ubi">Professor a Departament</p>
        </a>
    </article>

    <form action="/addTeacher" method="POST">
        <div id="box">
            <section id="capsa__individual">
                <div>
                    <label for="department" id="titul">Departament:</label>
                    <select name="department" id="department">
                        <option value="" id="course__option">Selecciona un departament</option>
                        <?php foreach($departaments as $departament): ?>
                            <option value="<?php echo $departament->getId(); ?>" id="course__option"><?php echo $departament->getName(); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </section>

                <section id="capsa__individual">
                    <div>
                        <label for="teacher" id="titul">Professor:</label>
                        <select name="teacher" id="teacher">
                            <option value="" id="course__option">Selecciona un professor</option>
                            <?php foreach($teachers as $teacher): ?>
                                <option value="<?php echo $teacher->getId(); ?>" id="course__option"><?php echo $teacher->getName(); ?></option>
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
