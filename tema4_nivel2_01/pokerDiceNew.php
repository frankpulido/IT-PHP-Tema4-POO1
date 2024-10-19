<?php
declare(strict_types=1);
final class PokerDiceNew {

/*
HE COMENTADO ATRIBUTO Y MÉTODOS QUE NO ESTOY USANDO (interface segregation === "trim the fat")
INTERFACE SEGREGATION : "A Class should perform only actions that are needed to fulfil its role. Any other action should be removed completely or moved somewhere else if it might be used by another Class in the future."
*/

// Atributo
protected $dice = ['As', 'K', 'J', '7', '8'];
//protected int $totalThrowsDice = 0;

/* Constructor
public function __construct($dice) {
    $this->dice = $dice;
}
*/

// Getters
public function getDice() {
    return $this->dice;
}

/*
public function getTotalThrowsDice() : int {
    return $this->totalThrowsDice;
}
*/

// "throwDice" (tirar el dado)
public function throwDice() {
    //$this->totalThrowsDice++;
    shuffle($this->dice);
}

// Función "ShapeNameDice" (resultado de la jugada)
public function shapeNameDice() : string {
    return $this->dice[0];
}
}
?>