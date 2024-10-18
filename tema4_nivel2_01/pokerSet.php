<?php
declare(strict_types=1);
require "pokerDiceNew.php";
final class PokerSet {

// Atributo
protected array $diceSet;
protected int $totalThrowsSet = 0;

// Constructor
public function __construct() {
    $this->diceSet = $this->initPokerSet();
}

// Initialize
public function initPokerSet() {
    $set = [];
    for($i = 0; $i<=4; $i++) {$set[] = new PokerDiceNew();}
    return $set;
}

// Getters
public function getDiceSet() {
    return $this->diceSet;
}

public function getTotalThrowsSet() : int {
    return $this->totalThrowsSet;
}

// Class Methods
public function throwDiceSet() {
    $this->totalThrowsSet++;
    for($i = 0; $i<=4; $i++) {$this->diceSet[$i]->throwDice();}
}

public function shapeNameDiceSet() : string {
    $shapes = "Outcome of set thrown : " . $this->diceSet[0]->shapeNameDice();
    for($i = 1; $i<=4; $i++) {$shapes = $shapes . " - " . $this->diceSet[$i]->shapeNameDice();}
    return $shapes;
}
}
?>