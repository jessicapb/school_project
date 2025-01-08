<?php
session_start()
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendari d'exàmens</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.css" rel="stylesheet">  
    <link rel="stylesheet" href="css/veurecamps/examen/veureexamen.css">
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
        <a id="localitzacio__enlac" href="/veureexamen">
            <p id="localitzacio__text--ubi">VEURE EXÀMENS</p>
        </a>
    </article>

    <!-- Calendario -->
    <section class="general">
        <div class="boxcalendari">
            <div id="calendar"></div>
        </div>
    </section>

    <!-- Fletxa puja -->
    <?php include 'parts/fletxadalt/fletxadalt.view.php'?>

    <!-- Footer -->
    <?php include 'parts/footer/footer.view.php'?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.2.0/locale/ca.js"></script>

    <script>
        $(document).ready(function() {
            var esdeveniments = <?php echo json_encode($esdeveniments); ?>;
            $('#calendar').fullCalendar({
                events: esdeveniments,
                locale: 'ca',
                header: {
                    left: '',
                    center: 'title',
                    right: 'prev,next'
                },
                eventClick: function(esdeveniments) {
                    alert('Esdeveniment: ' + esdeveniments.title + ' ' + esdeveniments.description);
                },
                noEventsMessage: 'No hi ha esdeveniments per mostrar'
            });
        });
    </script>
</body>
</html>
