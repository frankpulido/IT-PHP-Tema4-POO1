<?php
require "movie.php";
require "theater.php";
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

*/

$opcionMenu = -1;
$indexPeli = -1;
$indexCine = -1;
$continue = "x";

$countCinemas;
$cinemas = [];
$catalog = [];
$name = "";
$location = "";

$movie1 = new Movie("Dogville", "Lars von Trier", 2, 58);
$movie2 = new Movie("Magnolia", "Paul Thomas Anderson", 3, 8);
$movie3 = new Movie("La vida es bella", "Roberto Benigni", 1, 56);
$movie4 = new Movie("Coffee and Cigarettes", "Jim Jarmusch", 1, 35);
$movie5 = new Movie("Gran Torino", "Clint Eastwood", 1, 56);
$movie6 = new Movie("2001 : A Space Odissey", "Stanley Kubrick", 5, 5);
$movie7 = new Movie("The secret life of Walter Mitty", "Ben Stiller", 1, 54);
$movie8 = new  Movie("Layer Cake", "Matthew Vaughn", 1, 45);
$movie9 = new Movie("Sin City", "Frank Miller", 2, 4);
$movie10 = new Movie("The Island", "Michael Bay", 2, 16);
$movie11 = new Movie("Jerry Maguire", "Cameron Crowe", 2, 19);
$movie12 = new Movie("Wonder", "Stephen Chbosky", 1, 53);
$movie13 = new Movie("Once upon a time in... Hollywood", "Quentin Tarantino", 2, 41);
$movie14 = new Movie("Reservoir dogs", "Quentin Tarantino", 1, 39);
$movie15 = new Movie("Pulp fiction", "Quentin Tarantino", 2, 34);
$movie16 = new Movie("Meet the parents", "Jay Roach", 2, 42);
$movie17 = new Movie("Burn after reading", "Ethan & Joel Coen", 1, 37);

$movies = [$movie1, $movie2, $movie3, $movie4, $movie5, $movie6, $movie7, $movie8, $movie9, $movie10, $movie11, $movie12, $movie13, $movie14, $movie15, $movie16, $movie17];


echo "\nDe momento sólo podemos hacer servir la opción 1 del menú de usuario a continuación. Vamos a inicializar el sistema dando de alta por primera vez los cines y la oferta de funciones en cada uno de ellos :\n\n";

do {
    echo "\n";
    echo menu();
    echo "\n";
    $opcionMenu = (int)readline();
    switch($opcionMenu) {
        case 0 :
            break;
        case 1 :
            echo "\nHa escogido dar de alta salas de cines y la oferta de funciones en cada uno de ellos :\n\n";
            $cinemas[] = newTheater($movies);
            break;
        case 2 :
            break;
        case 3 :
            break;
        case 4 :
            break:
        case 5 :
            break;
        case 6 :
            break;
        default :
        break;
    }
} while ($opcionMenu != 0);



// A continuación el menu de usuario y las funciones que nos piden.

function menu() {
    echo "Menú de usuario :\n1- Dar de alta sala(s) de cine.\n2- Añadir función a sala(s) de cine.\n3- Mostrar funciones de una sala determinada.\n4- Buscar película de mayor duración en una sala determinada.\n5- Buscar que películas se están proyectando de un determinado director.\n6- Dar de alta nueva película al catálogo.";
}
function newTheater($movies) {
    $countCinemasNew = (int) readline("Cuantos cines quiere dar de alta? : ");
    for ($i = 0; $i < $countCinemasNew; $i++) {
        $name = readline("Nombre del cine " . ($i+1) . " : ");
        $location = readline("Población del cine $name : ");
        $cinemasNew [] = new movieTheather($name, $location);
        echo "\n";
    }
    echo "\nA continuación daremos de alta la oferta de cada sala de cine dada de alta anteriormente :\n";
    foreach ($cinemasNew as $cinema) {
        unset($catalog);
        $i = 0;
        echo "\nSeleccione las películas que quiere dar de alta en " . $cinema->getName() . " de " . $cinema->getLocation() . " :\n";
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

function addMovie(&$cinemas) { // hay que desarrollar
    echo "Seleccione la película a agregar, luego preguntaremos pot las salas";

    // Un avez seleccionada la peli preguntamos si añadir a TODAS o si sólo a alguna(s) : continuar desarrollando a continuación.
    $i = 0;
    foreach ($cinemas as $cinema) {
        echo $i . " " . $cinema->getName() . " - " . $cinema->getLocation . "\n";
        $i++;
    }

}

?>