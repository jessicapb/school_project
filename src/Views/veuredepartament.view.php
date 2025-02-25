<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veure departament</title>
    <link rel="stylesheet" href="css/veurecamps/departament/veurecamps.css">
    <link rel="icon" href="img/iconacole.png" type="image/x-icon">
</head>
<body>
    <!-- Link de navegación -->
    <?php include 'parts/nav/nav.view.php'?>

    <!-- Localización -->
    <article class="localitzacio">
        <a id="localitzacio__enlac" href="/index">
            <p id="localitzacio__text">INICI</p>
        </a>
        <img id="localitzacio__img" src="img/fletxes/fletxadreta.png" alt="fletxadreta">
        <a id="localitzacio__enlac" href="/veuredepartament">
            <p id="localitzacio__text--ubi">VEURE DEPARTAMENT</p>
        </a>
    </article>

    <section>
        <?php foreach($departments as $department) { ?>
            <div id="box">
                <div id="capsa">
                    <div id="capsa__individual">
                        <h1 id="capsa__titol">Nom:</h1> 
                        <p id="capsa__desc"><?php echo $department->getName() ?></p>
                    </div>
                    <div id="capsa__individual">
                        <h1 id="capsa__titol">Persones:</h1> 
                        <p id="capsa__desc"><?php echo $department->getPeople() ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>

    <!-- Fletxa puja -->
    <?php include 'parts/fletxadalt/fletxadalt.view.php'?>

    <!-- Footer -->
    <?php include 'parts/footer/footer.view.php'?>
</body>
</html>