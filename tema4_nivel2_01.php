<?php
/*

Frank Pulido - Tema 4 [POO1] - Nivel 2 - Ejercicio 1

ENUNCIADO :
Crea la clase PokerDice. Las caras de un dado de póquer tienen las siguientes figuras: As, K, Q, J, 7 y 8.
Crea el método throw que no hace otra cosa que echar el dado, es decir, genera un valor aleatorio para el objeto al que se le aplica el método.
Crea también el método shapeName, que diga cuál es la figura que ha salido en el último tirón del dado en cuestión.
Realiza una aplicación que permita echar cinco dados de póquer a la vez.
Además, programa el método getTotalThrows que debe mostrar el número total de tiradas entre todos los dados.

RECURSOS :
https://www.w3schools.com/php/func_array_shuffle.asp // reordeno los elementos y tomo el valor del primero con array_current()
https://www.w3schools.com/php/func_array_current.asp // tomar primer valor del array (quizás requiere hacer un reset() previo para reordenar claves)
https://www.w3schools.com/php/func_array_fill.asp // crear array de 5 dados
https://www.w3schools.com/php/func_array_walk.asp // ejecutar la misma función con 5 dados del array

*/

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

    // Métodos propios de la Clase

    // Función "throw" (tirar el dado)
    public function throwDice() {
        shuffle($this->dice);
        reset($this->dice);
        return $this->dice;
    }

    // Resultado de la jugada : reindexa $keys (sin alterar orden de $values) y me devuelve $dice[0]
    public function shapeName() {
        reset($this->dice);
        return current($this->dice);
    }


}

/*
class FunctionsPokerDice {
    public static function throw() { // Función "throw" (tirar el dado)
        shuffle($dice);
        return "Se ha jugado!!!...";
    }

    public static function shapeName() { // reindexa $keys (sin alterar orden de $values) y me devuelve $dice[0]
        reset($dice);
        return current($dice);
    }
}
*/

$dado = new PokerDice();
// $set5Dados = []; // No es necesario, la declaro e inicializo con una sola instrucción
$set5Dados = array_fill(0, 5, clone($dado));
$jugada = [];


echo "Os presentamos el dado usado en PokerDice : :\n";
var_dump ($dado);

echo "Vamos a lanzarlo, veamos como ha cambiado el orden de las caras del dado :\n";
$dado->throwDice();
var_dump ($dado);

echo "\nEl resultado del lanzamiento será la cara que corresponde a la posición [0] :\n";
echo $dado->shapeName();
echo "\n\n";

/*
Hemos comprobado que ambas funciones dan el resultado esperado con una instancia : $dado
Ahora debemos crear iteradores que nos permitan jugar con un array de 5 instancias : $set5Dados
El resultado de la jugada se almacenará en un array de Strings : $jugada
*/

echo "En cada jugada de \"Poker Dice\" deben lanzarse 5 dados.\n Ahora haremos lo mismo con un set de 5 dados. El set :\n";
echo "\n\n";
var_dump($set5Dados);
echo "\n\n";

echo "Lancemos!!!\n\n";
for ($i = 0; $i < count($set5Dados); $i++) {
    $eachDice = $set5Dados[$i];
    $arrayDados[$i] = $eachDice->throwDice(); // $array5Dados no es un array de objetos sino array 2D de Strings : 5 elementos con arrays de las caras de los $eachDice
}

var_dump($arrayDados);
//print_r($arrayDados);

$cadaResultado = "";
for ($i = 0; $i < count($set5Dados); $i++) {
    //$jugada [] = shapeName($set5Dados[$i]); // Lo escribí como en Java !!!
    /*
    $cadaResultado = $set5Dados[$i]->shapeName();
    $jugada[] = $cadaResultado;
    */
    $cadaResultado = $set5Dados[$i]->shapeName();
    //$eachDice = $set5Dados[$i];
    //$cadaResultado = $eachDice->shapeName();
    $jugada[] = $cadaResultado;
    //$cadaResultado = $eachDice->shapeName();
    //$jugada[$i] = $eachDice->shapeName();
    //$cadaResultado = $eachDice->shapeName();
    //echo "\nResultado dado $i : " . $jugada[$i];
    //$jugada[] = $set5Dados[$i];
}

echo "\n\n";
echo "La jugada tiene por resultado la posición [0] de cada uno de los 5 dados :\n\n";
print_r($jugada);



/*
print_r($set5Dados);
for ($i = 0; $i < count($set5Dados); $i++) {
    shuffle($set5Dados[$i]);
}
reset($set5Dados);
echo "Hemos lanzado los dados :\n";
print_r($set5Dados);
echo "Primer elemento de cada dado :\n";
$jugada[] = array_walk($set5Dados, "current");
print_r($jugada);
unset($jugada);
echo "Vaciamos el array del primer elemento :\n";
for ($i = 0; $i < count($set5Dados); $i++) {
    $jugada = $set5Dados[0];
}
echo "Lo rellenamos de nuevo de otra forma :\n";
print_r($jugada);
*/



/*
var_dump($set5Dados);
array_walk($set5Dados, "throw"); // Se pone la función entre comillas, sin pasar atributos
// array_walk($set5Dados, FunctionsPokerDice::throw());
$jugada[] = array_walk($set5Dados, "shapeName"); // Se pone la función entre comillas, sin pasar atributos
// $jugada[] = array_walk($set5Dados, FunctionsPokerDice::shapeName());
var_dump($set5Dados);
var_dump($jugada);
*/



?>