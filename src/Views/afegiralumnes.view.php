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
                <div>
                    <input class="uniodades__input" id="showpassword" type="password" placeholder="escriu la contrasenya." name="password" required>
                    <svg id=clickme width=28 height=25 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M569.354 231.631C512.97 135.949 407.81 72 288 72 168.14 72 63.004 135.994 6.646 231.631a47.999 47.999 0 0 0 0 48.739C63.031 376.051 168.19 440 288 440c119.86 0 224.996-63.994 281.354-159.631a47.997 47.997 0 0 0 0-48.738zM288 392c-102.556 0-192.091-54.701-240-136 44.157-74.933 123.677-127.27 216.162-135.007C273.958 131.078 280 144.83 280 160c0 30.928-25.072 56-56 56s-56-25.072-56-56l.001-.042C157.794 179.043 152 200.844 152 224c0 75.111 60.889 136 136 136s136-60.889 136-136c0-31.031-10.4-59.629-27.895-82.515C451.704 164.638 498.009 205.106 528 256c-47.908 81.299-137.444 136-240 136z"/></svg>
                </div>

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
                <input id="uniodades__input" type="number"  placeholder="escriu l'any d'inscripció." name="enrollment" required>
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
        if (isset($_SESSION['error'])) { 
        ?>
            const serverError = <?= json_encode($_SESSION['error']); ?>;
            <?php unset($_SESSION['error']);?>
        <?php
        } else {
        ?>
            const serverError = null;
        <?php
        }
        ?>
    </script>

    <!-- Carregar el Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Ensenya la contrasenya -->
    <script src="javascript/alumne/mostrarcontrasenya.js"></script>

    <!-- Fitxers dels errors -->
    <script src="javascript/alumne/error-alumne.js"></script>
</body>
</html>
