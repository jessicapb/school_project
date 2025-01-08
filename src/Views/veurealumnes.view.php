<?php
session_start()
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veure alumnes</title>
    <link rel="stylesheet" href="css/veurecamps/alumne/veurecamps.css">
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
        <a id="localitzacio__enlac" href="/veurealumne">
            <p id="localitzacio__text--ubi">VEURE ALUMNES</p>
        </a>
    </article>

    <!-- Mostrar els alumnes -->
    <div id="mostrar"></div>

    <!-- Fletxa puja -->
    <?php include 'parts/fletxadalt/fletxadalt.view.php'?>

    <!-- Footer -->
    <?php include 'parts/footer/footer.view.php'?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let mostrar = document.getElementById('mostrar');
            var students = <?php echo json_encode($students); ?>;

            var content = "";
            students.forEach(function(student) {
                content += `
                            <div id="box">
                                <div id="capsa">
                                    <div id="capsa__individual">
                                        <h1 id="capsa__titol">Nom:</h1> 
                                        <p id="capsa__desc">${student.name}<p/>
                                    </div>

                                    <div id="capsa__individual">
                                        <h1 id="capsa__titol">Cognoms:</h1> 
                                        <p id="capsa__desc">${student.surname}</p>
                                    </div>

                                    <div id="capsa__individual">
                                        <h1 id="capsa__titol">Número de telèfon:</h1> 
                                        <p id="capsa__desc">${student.phonenumber}</p>
                                    </div>

                                    <div id="capsa__individual">
                                        <h1 id="capsa__titol">Email:</h1>
                                        <p id="capsa__desc">${student.email}</p>
                                    </div>

                                    <div id="capsa__individual">
                                        <h1 id="capsa__titol">Curs:</h1>
                                        <p id="capsa__desc">${student.course}</p>
                                    </div>

                                    <div id="capsa__individual">
                                        <h1 id="capsa__titol">Assignatures:</h1>
                                        <p id="capsa__desc">${student.subject}</p>
                                    </div>
                                </div>
                            </div>`;
            });
            mostrar.innerHTML = content;
        });
    </script>
</body>
</html>