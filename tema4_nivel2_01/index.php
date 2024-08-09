<?php
require "pokerdice.php";
/*
Frank Pulido - Tema 4 [POO1] - Nivel 2 - Ejercicio 1

ENUNCIADO :
Crea la clase PokerDice. Las caras de un dado de póquer tienen las siguientes figuras: As, K, Q, J, 7 y 8.
Crea el método throw que no hace otra cosa que echar el dado, es decir, genera un valor aleatorio para el objeto al que se le aplica el método.
Crea también el método shapeName, que diga cuál es la figura que ha salido en el último tirón del dado en cuestión.
Realiza una aplicación que permita echar cinco dados de póquer a la vez.
Además, programa el método getTotalThrows que debe mostrar el número total de tiradas entre todos los dados.

RECURSOS :
https://www.w3schools.com/php/func_array_shuffle.asp // reordeno los elementos y tomo el valor del primero con array_current()
https://www.w3schools.com/php/func_array_current.asp // tomar primer valor del array (quizás requiere hacer un reset() previo para reordenar claves)
https://www.w3schools.com/php/func_array_fill.asp // crear array de 5 dados
https://www.w3schools.com/php/func_array_walk.asp // ejecutar la misma función con 5 dados del array
*/

$dado = new PokerDice();
$set5Dados = [];

for ($i = 0; $i <= 4; $i++) {
    $set5Dados[] = clone($dado);
}
$jugada = []; // $jugada almacenará el outcome de un lanzamiento de 5 dados : $set5Dados.
$jugadas = []; // $almacenará todos los outcomes de cada lanzamiento de los 5 dados.

$opcion = -1; // entrada del usuario, menú principal

echo "\nRubén : tengo un \"side effect\" al inicio (el require a la Clase PokerDice) y un \"declaration\" al final (método getTotalThrows) que creé en index porque me pareció demasiado\n";
echo "crear una nueva clase para el set de dados... Todos los jugadores pueden jugar con el mismo set. Al parecer esto es contrario al PSR-1: Basic Coding Standard... puedes orientarme?...\n\n";

do {
    echo "\nMenú de usuario :\n[1] Presentación del dado de Poker Dice y las funciones \"throwDice\" y \"shapeName\".\n[2] Presentación del set de 5 dados y la jugada.\n[3] Practica el lanzamiento y almacena los resultados con \"getTotalThrows\".\n[0] Salir.\n\n";
    $opcion = (int) readline("Que opción escoges? (1 al 3, salir : 0)\n");
    switch ($opcion) {
        case 1 :
            echo "\nOs presentamos el dado usado en PokerDice :\n";
            var_dump ($dado);
            echo "\nVamos a lanzarlo, veamos como ha cambiado el orden de las caras del dado :\n";
            $dado->throwDice();
            var_dump ($dado);
            echo "\nEl resultado del lanzamiento será la cara que corresponde a la posición [0] :\n";
            echo $dado->shapeName();
            echo "\n\n";
            break;
        case 2 :
            echo "En cada jugada de \"Poker Dice\" deben lanzarse 5 dados.\nPresentamos el set para que comprobéis las caras (el set se desprecinta delante del jugador, su peso y centro de gravedad están certificados) :\n";
            echo "\n";
            var_dump($set5Dados);
            echo "\n\n";
            echo "Lancemos!!!\n\n";
            for ($i = 0; $i < count($set5Dados); $i++) {
                $set5Dados[$i]->throwDice();
            }
            var_dump($set5Dados);
            echo "\nLa jugada tiene por resultado la posición [0] de cada uno de los 5 dados :\n";
            for ($i = 0; $i < count($set5Dados); $i++) {
                $jugada[] = $set5Dados[$i]->shapeName();
            }
            echo "\n";
            print_r($jugada);
            echo "\n";
            break;
        case 3 :
            // Crear la clase Jugador que tenga por atributos $nombre, $set5Dados y $jugadas[], además del método getTotalThrows.
            // Hacer el juego creando X instancias de la clase Jugador y ejecutando getTotalThrouws en un foreach del array de estas instancias.
            echo "Ya sabes como funcionan el objeto \"dado\" y el array \"set5dados\" que almacena 5 clones de \"dado\", así como los métodos \"throwDice\" y \"shapeName\" de la Clase PokerDice.\n";
            echo "Ahora usaremos el método \"getTotalThrows\" que te permitirá lanzar las veces que quieras y te mostrará el total de lanzamientos y su resultado.\n";
            echo "DEBERES : modificarlo para un juego de X jugadores\n\n";
            
            unset($jugadas);
            do {
                $jugar = (int) readline("Quieres lanzar los dados?\n[1] Si\n[0] No\n");
                switch ($jugar) {
                    case 0 :
                        echo "\nEsperamos que hayas tenido suerte, hasta la próxima!!\n";
                        break;
                    case 1 :
                        getTotalThrows($set5Dados, $jugadas); // La función está definida para el paso de variables por referencia
                        break;
                    default :
                        echo "Debes seleccionar una opción válida.\n\n";
                        break;
                }
            } while ($jugar!= 0);
            
            echo "\nHas lanzado el set de 5 dados un total de " . count($jugadas) . " veces en esta práctica.\n\n"; // En el método getTotalThrows la variable $totalThrows es static
            echo "El resultado de los " . count($jugadas) . " lanzamientos :\n\n"; // $totalThrows debe arrojar el mismo valor que count($jugadas) que se pasó "por referencia"
            print_r($jugadas);
            
            //getTotalThrows($set5Dados);
            echo "\n\n";
            break;
        case 0 :
            echo "Salida del sistema.\n";
            echo "\n\n";
            break;
        default :
        echo "Debes seleccionar una opción válida.\n";
            echo "\n\n";
            break;
    }
} while ($opcion != 0);


echo 'DUDA : Debería el atributo único $dice ser de tipo PRIVATE, en lugar de protected???
Estudiar con detenimiento la función getTotalThrows(). Necesité pasar las variables $set5Dados y $jugadas "por referencia" : &$set5Dados y &$jugadas.
Necesitaba que el valor de ambas (variables globales) se viese afectado durante la ejecución del método.
IMPORTANTE : no existe "return", sencillamente afecto sus valores. Hago un echo para verificar la cuenta de la variable static.
Revisar TODO el programa.
Recursos :
https://www.w3schools.com/php/php_superglobals_globals.asp
Scroll to "Passing Arguments by Reference" :
https://www.w3schools.com/php/php_functions.asp';
echo "\n";


function getTotalThrows(&$set5Dados, &$jugadas) { // pasamos las variables "por referencia" y no hacemos return. En "case 3" hacemos unset($jugadas)
    static $totalThrows = 0; // al ser static esta variable acumulará el total de lanzamientos usando la opción 3 para toda la sesión de usuario
    for ($i = 0; $i < count($set5Dados); $i++) {
        $set5Dados[$i]->throwDice();
        $jugada[] = $set5Dados[$i]->shapeName();
    }
    $totalThrows++;
    $jugadas[] = $jugada;
    echo "En esta práctica usted ha lanzado " . count($jugadas) . " veces.\nDurante la sesión de usuario usted ha lanzado un total de ". $totalThrows . " veces.\n";
}

/*
DUDA : Debería el atributo único $dice ser de tipo PRIVATE, en lugar de protected???
Estudiar con detenimiento la función getTotalThrows(). Necesité pasar las variables $set5Dados y $jugadas "por referencia" : &$set5Dados y &$jugadas.
Necesitaba que el valor de ambas (variables globales) se viese afectado durante la ejecución del método.
IMPORTANTE : no existe "return", sencillamente afecto sus valores.
Revisar TODO el programa.
Recursos :
https://www.w3schools.com/php/php_superglobals_globals.asp
Scroll to "Passing Arguments by Reference" :
https://www.w3schools.com/php/php_functions.asp
*/

?>