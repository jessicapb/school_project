<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afegir exàmens</title>
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
        <a id="localitzacio__enlac" href="/indexexamen">
            <p id="localitzacio__text--ubi">AFEGIR EXÀMENS</p>
        </a>
    </article>

    <!-- Formulari -->
    <form action="/saveexam" class="centrarform" method="POST">
        <fieldset id="centrarform__box">
            <div class="uniodades">
                <legend id="uniodades__titol">AFEGIR EXÀMENS</legend>

                <!-- Nom -->
                <label id="uniodades__label" for="">Nom</label>
                <input id="uniodades__input" placeholder="escriu el nom." type="text" name="nom" required>
                <p class="error-message" id="error-name"></p>

                <!-- Descripció -->
                <label id="uniodades__label" for="">Descripció</label>
                <textarea id="uniodades__input" name="descripcio" cols="40" placeholder="escriu la descripció." required></textarea>
                <p class="error-message" id="error-descripcio"></p>

                <!-- Dia -->
                <label id="uniodades__label" for="">Dia de l'examen</label>
                <input id="uniodades__input" type="date"  name="dia" required>
                <p class="error-message" id="error-dia"></p>

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

    <script src="javascript/examen/error-examen.js"></script>
</body>
</html>
