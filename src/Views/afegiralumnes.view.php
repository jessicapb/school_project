<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afegir alumnes</title>
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
        <a id="localitzacio__enlac" href="/indexalumne">
            <p id="localitzacio__text--ubi">AFEGIR ALUMNE</p>
        </a>
    </article>

    <!-- Formulari -->
    <form action="/savestudent" class="centrarform" method="POST">
        <fieldset id="centrarform__box">
            <div class="uniodades">
                <legend id="uniodades__titol">AFEGIR ALUMNE</legend>

                <!-- Nom -->
                <label id="uniodades__label" for="">Nom</label>
                <input id="uniodades__input" placeholder="escriu el nom." type="text" name="name" required>
                <p class="error-message" id="error-name"></p>

                <!-- DNI -->
                <label id="uniodades__label" for="">DNI</label>
                <input id="uniodades__input" placeholder="escriu el DNI." type="text" name="dni" required>
                <p class="error-message" id="error-dni"></p>

                <!-- Cognoms -->
                <label id="uniodades__label" for="">Cognoms</label>
                <input id="uniodades__input" type="text" placeholder="escriu els cognoms." name="surname" required>
                <p class="error-message" id="error-surname"></p>

                <!-- Contrasenya -->
                <label id="uniodades__label" for="">Contrasenya</label>
                <input id="uniodades__input" type="text" placeholder="escriu la contrasenya." name="password" required>
                <p class="error-message" id="error-password"></p>

                <!-- Número de telèfon -->
                <label id="uniodades__label" for="">Número telèfon</label>
                <input id="uniodades__input" type="text" placeholder="escriu el número de telèfon del tutor legal." name="phonenumber" required>
                <p class="error-message" id="error-phonenumber"></p>

                <!-- Correu electrònic -->
                <label id="uniodades__label" for="">Correu electrònic</label>
                <input id="uniodades__input" type="email" placeholder="escriu el correu electrònic." name="email" required>
                <p class="error-message" id="error-email"></p>

                <!-- Identificació -->
                <label id="uniodades__label" for="">RALC</label> <!-- Digits 10-->
                <input id="uniodades__input" type="number" placeholder="escriu el ralc." name="ident" required>
                <p class="error-message" id="error-ident"></p>

                <!-- Curs -->
                <label id="uniodades__label" for="">Curs</label>
                <input id="uniodades__input" type="text" placeholder="escriu el curs." name="course" required>
                <p class="error-message" id="error-course"></p>

                <!-- Assignatures -->
                <label id="uniodades__label" for="">Assignatures</label>
                <textarea id="uniodades__input" name="subject" cols="40" placeholder="escriu les assignatures." required></textarea>
                <p class="error-message" id="error-subject"></p>

                <!-- Any d'inscripció -->
                <label id="uniodades__label" for="">Any d'inscripció</label>
                <input id="uniodades__input" type="date"  name="enrollment" required>
                <p class="error-message" id="error-enrollment"></p>

                <!-- Botó afegir -->
                <div class="boxbt">
                    <button id="boxbt__afegir" type="submit">Afegir</button>
                    
                </div>
            </div>
        </fieldset>
    </form>
    
    <!-- Fletxa dalt -->
    <?php include 'parts/fletxadalt/fletxadalt.view.php'?>

    <!-- Link footer-->
    <?php include 'parts/footer/footer.view.php'?>
    <script>
        <?php 
        session_start();
        if (isset($_SESSION['error'])): 
        ?>
        const serverError = <?= json_encode($_SESSION['error']); ?>;
        <?php unset($_SESSION['error']); ?>
        console.log("Error del servidor: ", serverError); 
        <?php else: ?>
        const serverError = null;
        <?php endif; ?>
    </script>

    <script src="javascript/alumne/error-alumne.js"></script>
</body>
</html>
