<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School</title>
    <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>
    <?php include 'parts/nav.view.php';?>
    <article>
        <a id="localitzacio__enlac" href="/index">
            <p id="localitzacio__text">INICI</p>
        </a>
        <div class="boxgeneral">
            <div class="capsa">
                <h1 id="capsa__titol">Cursos</h1>
                <p>En aquest apartat veuràs tots els cursos que té l'escola.</p>
                <button id="capsa__bt">Veure cursos</button>
                <button id="capsa__bt">Cerca pel nom</button>
            </div>
        </div>

    </article>
    <?php include 'parts/footer.view.php';?>
</body>
</html>
