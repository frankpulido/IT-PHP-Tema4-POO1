<?php
declare(strict_types=1);
require "pokerDice.php";

/*

[ 2024 10 18 ] : CONTINUARÉ DESARROLLANDO ESTE EJERCICIO CON LA CLASE POKER DICE COMO UN SINGLETON
Ayer descubrí que existe un DESIGN PATTERN conocido como SINGLETON que es precisamente lo que quiero hacer con el dado.
IT Academy quiere que el ejercicio se haga instanciando 5 veces el dado, pero esto no tiene sentido. La razón es sencillamente un principio estadístico :
La probabilidad de obtener un resultado cualquiera de combinación de 5 lanzamientos es EXACTAMENTE LA MISMA en estos 3 casos :
1- Lanzando 5 dados a la vez.
2- Lanzando 5 dados de 1 en 1.
3. Lanzando un único dado, recogiéndolo y lanzándolo de nuevo 5 veces en total.

El método throwDice en cualquier caso ha de ejecutarse 5 veces, pero no tiene sentido estadístico hacerlo sobre 5 objetos distintos.
No nos interesa el dado (o los dados) en si mismos, nos interesa almacenar el resultado de los lanzamientos, algo que haremos en un atributo de la clase Player.
IMPORTANTE : REVISAR LA KATA DEL TENNIS PARA ESTA NUEVA CLASE.

*****

[ 2024 10 17 ] : El ejercicio para IT Academy pasa a 3 nuevos archivos en branch MAIN : indexNew.php - PokerDiceNew.php - pokerSet.php
He vuelto a la versión instanciable cambiando el atributo $dice por constante DICE... Me gustaba más la otra versión, tener todos los métodos de tipo static y no instanciar el Objeto sino dejarlo como "one of a kind" y sencillamente invocarlo en cada SWITCH-CASE con métodos que no requieren que se les pase parámetros :
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
            PokerDice::throwDice();
            echo PokerDice::shapeNameDice();
            echo PHP_EOL;
            break;
        case 2 :
            PokerDice::throwDiceSet();
            echo PokerDice::shapeNameSet();
            echo PHP_EOL;
            break;
        case 3 :
            echo PokerDice::getTotalThrowsDice();
            echo PHP_EOL;
            echo PokerDice::getTotalThrowsDiceExplained();
            echo PHP_EOL;
            break;
        case 4 :
            echo PokerDice::getTotalThrowsSet();
            echo PHP_EOL;
            break;
        default :
            break;
    }
} while($option != 0);

?>