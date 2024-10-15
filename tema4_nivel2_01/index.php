<?php
declare(strict_types=1);
require "pokerDice.php";

/* README RUBÉN
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