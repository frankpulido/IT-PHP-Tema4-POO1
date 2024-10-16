<?php
final class PokerDice {

    // Atributo
    private const DICE = ['As', 'K', 'J', '7', '8'];
    private static int $totalThrowsDice = 0;
    private static int $totalThrowsSet = 0;
    // Constructor : NOT NEEDED

    // Getters
    public function getDice() {
        return self::DICE;
    }
    public function getTotalThrowsDice() : int {
        return self::$totalThrowsDice;
    }
    public function getTotalThrowsDiceExplained() : string {
        return "A single dice has been thrown " . self::$totalThrowsDice . " times." . PHP_EOL . "[1] Alone : " . (self::$totalThrowsDice - self::$totalThrowsSet * 5) . PHP_EOL . "[2] As part of the set : " . self::$totalThrowsSet * 5 . " (" . self::$totalThrowsSet . " * 5).";
    }
    public function getTotalThrowsSet() : int {
        return self::$totalThrowsSet;
    }

    // "throwDice" (tirar el dado)
    public function throwDice() : int {
        self::$totalThrowsDice++;
        return random_int(0,4);
    }

    // Función "ShapeNameDice" (resultado de la jugada)
    public function shapeNameDice() : string {
        return "The outcome of the dice thrown is : " . self::DICE[self::throwDice()];
    }

    // Función "ShapeNameSet" (resultado de tirar el set de 5 dados)
    public function shapeNameSet() : string {
        $reply = "The Set contains 5 dice. The 5 outcomes :" . PHP_EOL;
        self::$totalThrowsSet++;
        for($i = 1; $i <= 5; $i++) {
            $reply = $reply . self::shapeNameDice() . " [Dice $i]." . PHP_EOL;
        }
        return $reply;
    }
}
?>