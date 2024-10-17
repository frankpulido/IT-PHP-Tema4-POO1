<?php
declare(strict_types=1);
require "pokerDice.php";

/* README RUBÉN

[ 2024 10 17 ] : He vuelto a la versión instanciable cambiando el atributo $dice por constante DICE... Me gustaba más la otra versión, tener todos los métodos de tipo static y no instanciar el Objeto sino dejarlo como "one of a kind" y sencillamente invocarlo en cada SWITCH-CASE con métodos que no requieren que se les pase parámetros :
case 1 : PokerDice::method1()
case 2 : PokerDice::method2()
case 3 : PokerDice::method3()
Los jugadores si serían una clase instanciable, pero TODOS jugarían con el mismo PokerDice, EL POKERDICE (la clase).

class Player(string $name, array $outcomesSetThrown)
class Game(array $players)

Al ser $totalThrowsSet un atributo static de PokerDicer almacenará los lanzamientos de TODOS los jugadores.

Si hago una pausa en el juego y necesito conocer a quien le toca jugar : count($players) - fmod($totalThrowsSet, count($players)) + 1
(el array $players atributo de class Game es no asociativo y empieza en 0)

*****

[ 2024 10 15 ]
Espero haberlo conseguido esta vez.
Durante la tutoría que hicimos al terminar el examen 2 (2024 10 10) te estuve preguntado sobre el uso del SELF y del modificador STATIC.
Estaba pensando en rehacer los ejercicios de POO1.
Empiezo con el más sencillo.
Me di cuenta de que al acabar de estudiar ARRAYS me dediqué a poner en práctica lo recién aprendido usando todas las funciones posibles de ARRAYS y si bien conseguí practicar mucho el tema anterior, no conseguí el objetivo del ejercicio siguiendo la metodología del array KISS.
$KISS = ['Keep', 'It', 'Simple', 'Stupid'];
*** IMPORTANTE  : Estadísticamente, las probabilidades de obtener una combinación cualquiera de 5 resultados lanzando un set de 5 dados es la misma que la de obtener la misma combinación lanzando un único dado 5 veces.

*/

$dice = new PokerDice;
$option = -1;

do {
    echo PHP_EOL;
    echo "0. Exit." . PHP_EOL . "1. Throw PokerDice." . PHP_EOL . "2. Throw PokerDice Set." . PHP_EOL . "3. Get the times a single dice has been thrown alone or as part of the set (5 dice)." . PHP_EOL . "4. Get the times the set of five dice has been thrown" . PHP_EOL;
    echo PHP_EOL;
    $option = (int) readline("Your option : ");
    echo PHP_EOL;
    switch ($option) {
        case 0 :
            echo "See you later, alligator!!!..." . PHP_EOL;
            echo PHP_EOL;
            break;
        case 1 :
            echo $dice->shapeNameDice();
            echo PHP_EOL;
            break;
        case 2 :
            echo $dice->shapeNameSet();
            echo PHP_EOL;
            break;
        case 3 :
            echo $dice->getTotalThrowsDice();
            echo PHP_EOL;
            echo $dice->getTotalThrowsDiceExplained();
            echo PHP_EOL;
            break;
        case 4 :
            echo $dice->getTotalThrowsSet();
            echo PHP_EOL;
            break;
        default :
            break;
    }
} while($option != 0);

?>