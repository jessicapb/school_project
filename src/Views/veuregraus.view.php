<?php
session_start()
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veure graus</title>
    <link rel="stylesheet" href="css/veurecamps/grau/veurecamps.css">
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
        <a id="localitzacio__enlac" href="/veuregrau">
            <p id="localitzacio__text--ubi">VEURE GRAUS</p>
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
            var degrees = <?php echo json_encode($degrees); ?>;

            var content = "";
            degrees.forEach(function(degrees) {
                content += `
                            <div id="box">
                                <div id="capsa">
                                    <div id="capsa__individual">
                                        <h1 id="capsa__titol">Nom:</h1> 
                                        <p id="capsa__desc">${degrees.name}<p/>
                                    </div>

                                    <div id="capsa__individual">
                                        <h1 id="capsa__titol">Duració:</h1> 
                                        <p id="capsa__desc">${degrees.duration_years}</p>
                                    </div>
                                </div>
                            </div>`;
            });
            mostrar.innerHTML = content;
        });
    </script>
</body>
</html>