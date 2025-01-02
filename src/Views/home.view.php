<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School</title>
    <link rel="stylesheet" type="text/css" href="css/home.css">
    <link rel="icon" href="img/iconacole.png" type="image/x-icon">
</head>
<body>
    <!-- Link navegació-->
    <?php include 'parts/nav/nav.view.php'?>

    <article>
        <a id="localitzacio__enlac" href="/index">
            <p id="localitzacio__text">INICI</p>
        </a>
        <div class="general">
            <div>
                <!-- Alumne -->
                <div class="capsa">
                        <h1 id="capsa__titol">Alumne</h1>
                        <p id="capsa__desc">En aquest apartat veuràs tots els alumnes que té l'escola.</p>
                        <a href="/veurealumne">
                            <button id="capsa__bt">Veure alumnes</button>
                        </a>
                        <button id="capsa__bt">Cerca pel nom</button>
                </div>

                <!-- Assignatura -->
                <div class="capsa">
                            <h1 id="capsa__titol">Assignatura</h1>
                            <p id="capsa__desc">En aquest apartat veuràs totes les assignatures que té l'escola.</p>
                            <button id="capsa__bt">Veure assignatures</button>
                            <button id="capsa__bt">Cerca pel nom</button>
                </div>

                <!-- Cursos -->
                <div class="capsa__petitat">
                    <h1 id="capsa__titol">Cursos</h1>
                    <p id="capsa__desc">En aquest apartat veuràs tots els cursos que té l'escola.</p>
                    <button id="capsa__bt">Veure cursos</button>
                    <button id="capsa__bt">Cerca pel nom</button>
                </div>

                <!-- Departament -->
                <div class="capsa">
                    <h1 id="capsa__titol">Departament</h1>
                    <p id="capsa__desc">En aquest apartat veuràs tots els departaments que té l'escola.</p>
                    <button id="capsa__bt">Veure departaments</button>
                    <button id="capsa__bt">Cerca pel nom</button>
                </div>

                <!-- Exàmens -->
                <div class="capsa">
                    <h1 id="capsa__titol">Examen</h1>
                    <p id="capsa__desc">En aquest apartat veuràs tots els exàmens que té l'escola.</p>
                    <a href="/veureexamen">
                        <button id="capsa__bt">Veure exàmens</button>
                    </a>
                    
                    <button id="capsa__bt">Cerca pel nom</button>
                </div>
                <div class="capsa">
                    <h1 id="capsa__titol">Departament</h1>
                    <p id="capsa__desc">En aquest apartat veuràs tots els departaments que té l'escola.</p>
                    <button id="capsa__bt">Veure departaments</button>
                    <button id="capsa__bt">Cerca pel nom</button>
                </div>
                <div class="capsa">
                    <h1 id="capsa__titol">Departament</h1>
                    <p id="capsa__desc">En aquest apartat veuràs tots els departaments que té l'escola.</p>
                    <button id="capsa__bt">Veure departaments</button>
                    <button id="capsa__bt">Cerca pel nom</button>
                </div>
            </div>
        </div>
    </article>

    <!-- Fletxa dalt -->
    <?php include 'parts/fletxadalt/fletxadalt.view.php'?>

    <!-- Link footer-->
    <?php include 'parts/footer/footer.view.php'?>
</body>
</html>
