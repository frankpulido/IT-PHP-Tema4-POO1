<?php
require_once __DIR__ . '/models/director.php';
require_once __DIR__ . '/models/movie.php';
require_once __DIR__ . '/models/theater.php';
/*
Frank Pulido - Tema 4 [POO1] - Nivel 3 - Ejercicio 1

ENUNCIADO :
Imagina que debes presentar el catálogo de películas de una cadena de cines. Cada cine tiene un nombre, una población a la que pertenece, y un listado de películas.
Cada película tiene un nombre, una duración y un director/a.

Se trata de hacer un programa que nos permita grabar esta información para después:

    Para cada cine, mostrar los datos de cada película.
    Para cada cine, mostrar la película con mayor duración.
    Implementa una función que busque por el nombre del director/a películas en diferentes cines. No hace falta repetir películas.

Además, puedes aprovechar este ejercicio para trabajar una buena presentación con HTML+CSS que apoye la lógica.

RECURSOS :

IDEAS :
1) PARA MOSTRAR CATÁLOGO DE PELIS CON NÚMERO QUE DIGA EN CUANTOS CINES ESTÁ (INCLUIDO EL CERO).
Usar in_array() para buscar el objeto : buscamos la peli en todos los cines e incrementamos el contador cuando la consigue. También podemos incorporar al cine en array de cines si se consigue la película usando in_array() y el contador sería la longitud del array de cines.

2) PARA BUSCAR LAS PELIS DE UN DETERMINADO DIRECTOR
2-A) Usar array_unique() : Una vez extraídos los resultados esta función filtra para no repetir objetos (purgar arrays de resultados)
https://www.w3schools.com/php/func_array_unique.asp
2-B) Usar array_count_values() : Damos valores únicos y sus ocurrencias (frecuencia del valor)
https://www.w3schools.com/php/func_array_count_values.asp
Una vez construido puede separarse en 2 arrays : Keys and Values usando 2 funciones :
array_keys() : https://www.w3schools.com/php/func_array_keys.asp
array_values() : https://www.w3schools.com/php/func_array_values.asp

3) Puedo usar enum para : 1) filtrar mostrando sólo un cine 2) dar formato distinto a las películas no exhibidas en ningún cine
4) Debo subir la imagen de la peli como atributo del objeto

*/

$opcionMenu = -1;
$indexPeli = -1;
$indexCine = -1;
$continue = "x";

$title = "";
$director = "";
$hours = 0;
$minutes = 0;

$countCinemas;
$cinemas = [];
$movies = [];
$catalog = [];
$directors = [];
$name = "";
$location = "";

$movie1 = new Movie("Dogville", "Lars von Trier", 2, 58);
$movie2 = new Movie("Magnolia", "Paul Thomas Anderson", 3, 8);
$movie3 = new Movie("La Vida Es Bella", "Roberto Benigni", 1, 56);
$movie4 = new Movie("Coffee And Cigarettes", "Jim Jarmusch", 1, 35);
$movie5 = new Movie("Gran Torino", "Clint Eastwood", 1, 56);
$movie6 = new Movie("2001 : A Space Odissey", "Stanley Kubrick", 2, 29);
$movie7 = new Movie("The Secret Life Of Walter Mitty", "Ben Stiller", 1, 54);
$movie8 = new  Movie("Layer Cake", "Matthew Vaughn", 1, 45);
$movie9 = new Movie("Sin City", "Frank Miller", 2, 4);
$movie10 = new Movie("The Island", "Michael Bay", 2, 16);
$movie11 = new Movie("Jerry Maguire", "Cameron Crowe", 2, 19);
$movie12 = new Movie("Wonder", "Stephen Chbosky", 1, 53);
$movie13 = new Movie("Once Upon A Time In... Hollywood", "Quentin Tarantino", 2, 41);
$movie14 = new Movie("Reservoir Dogs", "Quentin Tarantino", 1, 39);
$movie15 = new Movie("Pulp Fiction", "Quentin Tarantino", 2, 34);
$movie16 = new Movie("Meet The Parents", "Jay Roach", 1, 48);
$movie17 = new Movie("Burn After Reading", "Ethan & Joel Coen", 1, 36);

$movies = [$movie1, $movie2, $movie3, $movie4, $movie5, $movie6, $movie7, $movie8, $movie9, $movie10, $movie11, $movie12, $movie13, $movie14, $movie15, $movie16, $movie17];
$directors = allDirectors($movies);

echo "\nDe momento sólo podemos hacer servir la opción 1 del menú de usuario a continuación. Vamos a inicializar el sistema dando de alta por primera vez los cines y la oferta de funciones en cada uno de ellos :\n";

do {
    echo "\n";
    echo menu();
    echo "\n";
    $opcionMenu = (int)readline();
    switch($opcionMenu) {
        case 0 :
            echo "\nSe ha cerrado la sesión de usuario.\n\n";
            break;
        case 1 :
            echo "\nHa escogido dar de alta nuevas salas de cines y la oferta de películas a ser exhibidas en cada una de ellas :\n\n";
            $cinemas = array_merge($cinemas, newTheater($movies));
            break;
        case 2 :
            echo "\nHa escogido dar de alta película(s) a exhibirse en Salas de Cine ya existentes :\n\n";
            addMovie($cinemas, $movies);
            break;
        case 3 :
            echo "\nHa escogido mostrar las funciones de una determinada Sala de Cine. Las Salas :\n\n";
            showing($cinemas);
            break;
        case 4 :
            echo "\nHa escogido buscar la función de mayor duración en una determinada Sala de Cine. Nuestras Salas de Cine :\n\n";
            longerShowing($cinemas);
            break;
        case 5 :
            echo "\nHa escogido buscar las funciones de un determinado Director de Cine.\n";
            $screening = searchDirector($directors, $cinemas);
            if(count($screening)>0) {
                foreach ($screening as $key=>$value) {
                    echo "\nTítulo : $key / Se exhibe actualmente en $value Sala(s) de Cine.\n\n";
                }
            }
            else {
                echo "Actualmente no estamos exhibiendo ninguna película del Director indicado.\n\n";
            }
            break;
        case 6 :
            echo "\nHa escogido dar de alta una nueva película en el Catálogo General de películas.\n\n";
            $title = readline("Indique el Título de la Película : ");
            $director = readline("Indique el Director de la Película : "); // Esto hay que nodificarlo para que elija entre Directores Existentes o de no existir le de de alta
            $hours = (int) readline("La duración de la película está expresada en \"HORAS\" y \"MINUTOS\". Indique primero las HORAS : ");
            $minutes = (int) readline("Indique ahora los MINUTOS : ");
            $movies [] = newMovie($title, $director, $hours, $minutes);
            echo "\nLa nueva película ha sido dada de alta :\n" . $movies[count($movies)-1] . "\n\n";
            break;
        default :
        break;
    }
} while ($opcionMenu != 0);


// A continuación el menu de usuario y las funciones que nos piden. LLEVAR LAS FUNCIONES A UN TREAT O COMO SEA QUE SE LLAME EL ARCHIVO
// PELÍCULAS : QUIZÁS CREAR EL CATÁLOGO EN OTRO ARCHIVO Y HACER LA VARIABLE DE TIPO STATIC

function menu() {
    echo "Menú de usuario :\n1- Dar de alta sala(s) de cine.\n2- Añadir función a sala(s) de cine.\n3- Mostrar funciones de una sala determinada.\n4- Buscar película de mayor duración en una sala determinada.\n5- Buscar que películas se están proyectando de un determinado director.\n6- Dar de alta nueva película al catálogo.\n0- Salir del sistema.\n";
}
function newTheater($movies) {
    $countCinemasNew = (int) readline("Cuantos cines quiere dar de alta? : ");
    for ($i = 0; $i < $countCinemasNew; $i++) {
        echo "\n";
        $name = readline("Nombre del cine " . ($i+1) . " : ");
        $location = readline("Población del cine $name : ");
        $screens = readline("Número de salas de cine : ");
        $cinemasNew [] = new MovieTheater($name, $location, $screens);
    }
    echo "\nA continuación daremos de alta la oferta de cada sala de cine dada de alta anteriormente.\n";
    foreach ($cinemasNew as $cinema) {
        unset($catalog);
        $i = 0;
        echo "\nSeleccione las películas que quiere dar de alta en " . $cinema->getName() . " de " . $cinema->getCity() . " :\n";
        foreach ($movies as $movie) {
            echo "\n";
            echo $i . " " . $movie->aboutMovie(); // quizás deba usar un iterador $i como en la funcion al final
            $i++;
        }
        echo "\n";
        do {
            echo "\n";
            $indexPeli = (int) readline("Número de la película : ");
            $catalog [] = $movies[$indexPeli];
            $continue = readline ("Añadir otra película? \"Y\" para continuar o \"N\" para salir : ");
        } while ($continue != "N" && $continue != "n");
        $cinema->setShowing($catalog);
    }
    return $cinemasNew;
}

function newMovie($title, $director, $hours, $minutes) {
    $newMovie = new Movie($title, $director, $hours, $minutes);
    return $newMovie;
}

function addMovie(&$cinemas, $movies) { // hay que revisar el desarrollo : LÍNEA 149 y LÍNEA 161 (Cómo añadir nuevo objeto Movie al atributo Array del objeto MovieTheater)
    //global $cinemas;
    //global $movies;
    do {
        echo "\nSeleccione la película a agregar, luego preguntaremos las salas en las que va a exhibirse.\n";
        $i = 0;
        foreach ($movies as $movie) {
            echo "\n";
            echo $i . " " . $movie->aboutMovie(); // quizás deba usar un iterador $i como en la funcion al final
            $i++;
        }
        echo "\n\n";
        $indexPeli = (int) readline("Número de la película a añadir : ");
        
        // Una vez seleccionada la peli preguntamos si añadir a TODAS las Salas o si sólo a alguna(s) : continuar desarrollando a continuación.

        echo "\n";
        echo "La película se exhibirá en TODAS las Salas de Cine?\n";
        $todas = readline ("Indique \"Y\" para añadir a TODAS las Salas o \"N\" para seleccionar a cuales : ");
        if ($todas != "N" && $todas != "n") {
            $catalog = [];
            foreach ($cinemas as $cinema) {
                unset($catalog);
                $catalog = $cinema->getShowing();
                $catalog [] = $movies[$indexPeli];
                $cinema->setShowing($catalog);
            }
        }
        else {
            $i = 0;
            foreach ($cinemas as $cinema) {
                echo $i . " " . $cinema->getName() . " - " . $cinema->getLocation() . "\n";
                $i++;
            }
            do {
                echo "\n";
                $indexCine = (int) readline("Número de la Sala de Cine a la que quiere agregar la película : ");
                unset($catalog);
                $catalog = $cinemas[$indexCine]->getShowing();
                $catalog [] = $movies[$indexPeli];
                $cinemas[$indexCine]->setShowing($catalog);
                $continue = readline("Añadir la película seleccionada a otra Sala de Cine? \"Y\" para continuar añadiendo o \"N\" para salir : ");
            } while ($continue != "N" && $continue != "n");
            echo "\n";
        }
        $continue = readline ("Desea añadir otra película a la cartelera? \"Y\" para continuar o \"N\" para salir : ");
    } while ($continue != "N" && $continue != "n");
}

function showing($cinemas) {
    $i = 0;
    foreach ($cinemas as $cinema) {
        echo "[$i] " . $cinema->getName() . " - " . $cinema->getLocation() . "\n";
        $i++;
    }
    echo"\n";
    $indexCine = (int)readline("Indique el número de la Sala de Cine \"[?]\" cuyas funciones desea conocer : ");
    echo "\n";
    echo "Funciones de la Sala de Cine " . $cinemas[$indexCine]->getName() . " de " . $cinemas[$indexCine]->getCity() . " :\n";
    unset($catalog);
    $catalog = $cinemas[$indexCine]->getShowing();
    echo "\n";
    foreach ($catalog as $movie) {
        echo $movie->aboutMovie() . "\n";
    }
}

function longerShowing($cinemas) {
    $i = 0;
    $longest = 0;
    $indexPeli = -1;
    foreach ($cinemas as $cinema) {
        echo "[$i] " . $cinema->getName() . " - " . $cinema->getLocation() . "\n";
        $i++;
    }
    echo"\n";
    $indexCine = (int)readline("Indique el número de la Sala de Cine \"[?]\" para la que desea conocer la función de mayor duración : ");
    echo "\n";
    $catalog = $cinemas[$indexCine]->getShowing();
    $i = 0;
    foreach($catalog as $movie) {
        if($movie->getLength() > $longest) {
            $indexPeli = $i;
            $longest = $movie->getLength();
        }
        $i++;
    }
    echo "La película de mayor duración exhibida actualmente en la Sala " . $cinemas[$indexCine]->getName() . " es :\n" . $catalog[$indexPeli]->aboutMovie() . "\n\n";
}

function searchDirector($directors, $cinemas) {
    $catalog = [];
    $screening = [];
    $directorsCount = count($directors);
    $directorsNames = array_keys($directors);
    $directorsTitles = array_values($directors);
    echo "A continuación el total de Directores en nuestro catálogo de películas :\n";
    for ($i = 0; $i < $directorsCount; $i++) {
        echo "\n [" . $i . "] ". $directorsNames[$i] . " . Total títulos : " . $directorsTitles[$i];
    }
    echo "\n";
    $choice = readline("\nIndíque la posición entre corchetes \"[?]\" del Director de su elección y le diremos si existen películas en cartelera actualmente : ");
    foreach($cinemas as $cinema) {
        unset($catalog);
        $catalog = $cinema->getShowing();
        foreach($catalog as $movie) {
            if($directorsNames[$choice] == $movie->getDirector()) {
                array_push($screening, $movie->getTitle());
            }
        }
    }
    $screening = array_count_values($screening);
    return $screening;
}

function allDirectors($movies) {
    $directors = [];
    foreach($movies as $movie) {
        $directors [] = $movie->getDirector();
    }
    $directors = array_count_values($directors);
    return $directors;
}

?>