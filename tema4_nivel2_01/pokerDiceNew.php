<?php
declare(strict_types=1);
final class PokerDiceNew {

// Atributo
protected $dice = ['As', 'K', 'J', '7', '8'];
protected int $totalThrowsDice = 0;

/* Constructor
public function __construct($dice) {
    $this->dice = $dice;
}
*/

// Getters
public function getDice() {
    return $this->dice;
}

public function getTotalThrowsDice() : int {
    return $this->totalThrowsDice;
}

// "throwDice" (tirar el dado)
public function throwDice() {
    $this->totalThrowsDice++;
    shuffle($this->dice);
}

// Función "ShapeNameDice" (resultado de la jugada)
public function shapeNameDice() : string {
    return $this->dice[0];
}
}
?>