<?php
class PokerDice {

    // Atributo
    protected $dice = []; // No quiero que sea posible alterar los valores desde la aplicación

    // Constructor
    public function __construct($dice = ['As', 'K', 'J', '7', '8']) {
        $this->dice = $dice;
    }

    // Getter
    public function getDice() {
        return $this->dice;
    }

    // Setter : NO HACEMOS SETTER, el dado no debe ser modificado.

    // MÉTODOS PROPIOS DE LA CLASE : throwDice() y shapeName()

    // Función "throwDice" (tirar el dado) : hace un shuffle para cambiar aleatoriamente el orden de los elementos y un reset para reindexar.
    public function throwDice() {
        shuffle($this->dice);
        reset($this->dice);
        //return $this->dice;
        /* 
        podríamos cambiar la app para que sólo haga el shuffle, sin return, y evitarnos quizás variables auxiliares que sólo sirven para presentar el estado de los dados
        por pantalla y mostrar como funciona el programa.
        */
    }

    // Función "ShapeName" (resultado de la jugada) : reindexa $keys (sin alterar orden de $values) y me devuelve $dice[0]
    public function shapeName() {
        reset($this->dice);
        /*
        con el reset ya hecho en throwDice() después del shuffle, este otro es redundante, pero de momento lo dejo hasta haber hecho el juego con varios jugadores
        y estar seguro de que no es necesario.
        */
        return current($this->dice);
    }
}

?>