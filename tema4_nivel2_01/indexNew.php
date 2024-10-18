<?php
declare(strict_types=1);
require "pokerSet.php";

$diceSet = new PokerSet;
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