<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afegir professors</title>
    <link rel="stylesheet" href="css/afegirform/afegirform.css">
    <link rel="icon" href="img/iconacole.png" type="image/x-icon">
</head>
<body>
    <!-- Link navegació-->
    <?php include 'parts/nav/nav.view.php'?>

    <!-- Localització -->
    <article class="localitzacio">
        <a id="localitzacio__enlac" href="/index">
            <p id="localitzacio__text">INICI</p>
        </a>
        <img id="localitzacio__img" src="img/fletxes/fletxadreta.png" alt="fletxadreta">
        <a id="localitzacio__enlac" href="/indexprofessor">
            <p id="localitzacio__text--ubi">AFEGIR PROFESSOR</p>
        </a>
    </article>

    <!-- Formulari -->
    <form action="/saveteacher" class="centrarform" method="POST">
        <fieldset id="centrarform__box">
            <div class="uniodades">
                <legend id="uniodades__titol">AFEGIR PROFESSOR</legend>

                <!-- Nom -->
                <label id="uniodades__label" for="">Nom</label>
                <input id="uniodades__input" placeholder="escriu el nom." type="text" name="name" required>
                <p class="error-message" id="error-name"></p>

                <!-- Cognoms -->
                <label id="uniodades__label" for="">Cognoms</label>
                <input id="uniodades__input" type="text" placeholder="escriu els cognoms." name="surname" required>
                <p class="error-message" id="error-surname"></p>

                <!-- DNI -->
                <label id="uniodades__label" for="">DNI</label>
                <input id="uniodades__input" placeholder="escriu el DNI." type="text" name="dni" required>
                <p class="error-message" id="error-dni"></p>

                <!-- Correu electrònic -->
                <label id="uniodades__label" for="">Correu electrònic</label>
                <input id="uniodades__input" type="email" placeholder="escriu el correu electrònic." name="email" required>
                <p class="error-message" id="error-email"></p>

                <!-- Botó afegir -->
                <div class="boxbt">
                    <button id="boxbt__afegir" type="submit">Afegir</button>
                    
                </div>
            </div>
        </fieldset>
    </form>

    <!-- Link footer-->
    <?php include 'parts/footer/footer.view.php'?>
    <script>
        <?php 
        session_start();
        if (isset($_SESSION['error'])): 
        ?>
        const serverError = <?= json_encode($_SESSION['error']); ?>;
        <?php unset($_SESSION['error']); ?>
        <?php else: ?>
        const serverError = null;
        <?php endif; ?>
    </script>

    <script src="javascript/professor/error-professor.js"></script>
</body>
</html>
