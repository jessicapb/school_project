<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/parts/nav/nav.css">
    <title>Navbar</title>
</head>

<body>
    <header>
        <h1 class="titol__nav">SCHOOL</h1>
            <nav class="boxdown">
                <div class="boxinfo">
                    <a href="/index" id="boxinfo__text">Inici</a>
                    <a href="/indexnosaltres" id="boxinfo__text">Nosaltres</a>
                    <div class="dropdown">
                        <p id="boxinfo__text--afegir">Afegir</p>
                        <div class="dropdown-content">
                            <a href="/indexalumne">Alumne</a>
                            <a href="/indexassignatura">Assignatura</a>
                            <a href="/indexcurs">Curs</a>
                            <a href="/indexdepartament">Departament</a>
                            <a href="/indexexamen">Examen</a>
                            <a href="/indexgraus">Graus</a>
                            <a href="/indexprofessor">Professor</a>
                        </div>
                    </div> 

                    <div class="dropdown">
                        <p id="boxinfo__text--diff">Assignar</p>
                        <div class="dropdown-content" id="despegable__gran">
                            <a href="/indexprofessordepartament">Professor a Departament</a>
                            <a href="/indexcursgrau">Curs a Grau</a>
                            <a href="/afegircurs">Curs a Assignatura</a>
                            <a href="/indexcursalumne">Alumne a Curs</a>
                        </div>
                    </div> 
                </div>

                <div class="boxbt">
                    <button id="boxbt__format">Contacte</button>
                </div>
            </nav>
        <hr class="linia__nav">
    </header>
</body>
</html>