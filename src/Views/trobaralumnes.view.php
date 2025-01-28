<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar alumne</title>
    <link rel="stylesheet" href="css/buscador/buscador.css">
    <link rel="icon" href="img/iconacole.png" type="image/x-icon">
</head>
<body>
    <!-- Link navegació-->
    <?php include 'parts/nav/nav.view.php'?>
    <div class="general">
        <form action="" method="POST">
            <label for="">Troba l'alumne: </label>
            <div class="search">
                <div>
                    <input type="text" placeholder="escriu el dni que vols buscar">
                    <button id="btbuscar" type="submit">
                        <img id="lupa" src="img/buscador/lupa.png" alt="">
                    </button>
                </div>

            </div>

        </form>
    </div>
    <!-- Link footer-->
    <?php include 'parts/footer/footer.view.php'?>
</body>
</html>