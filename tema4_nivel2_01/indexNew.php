<?php
declare(strict_types=1);
require "pokerSet.php";

$diceSet = new PokerSet; // He instanciado el dado 5 veces en el constructor de PokerSet
$option = -1;

do {
    echo PHP_EOL;
    echo "0. Exit." . PHP_EOL . "1. Throw Set of 5 PokerDice." . PHP_EOL . "2. Get the times the set of five dice has been thrown" . PHP_EOL;
    echo PHP_EOL;
    $option = (int) readline("Your option : ");
    echo PHP_EOL;
    switch ($option) {
        case 0 :
            echo "See you later, alligator!!!..." . PHP_EOL;
            echo PHP_EOL;
            break;
        case 1 :
            $diceSet->throwDiceSet();
            echo $diceSet->shapeNameDiceSet();
            echo PHP_EOL;
            break;
        // Del enunciado no me queda claro si se desea conocer el número de lanzamientos del SET o si hay que decir también el total de dados que han rodado sobre la mesa
        // En la versión en la que instanciaba un único dado reportaba ambos, puedo reintegrar esta forma de reportar los lanzamientos.
        case 2 :
            echo "The Dice Set (5 Poker Dice) has been thrown " . $diceSet->getTotalThrowsSet() . " times.";
            echo PHP_EOL;
            break;
        default :
            echo "You have to select a valid option [0-1-2]" . PHP_EOL;
            echo PHP_EOL;
            break;
    }
} while($option != 0);
?>