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


$dado = new PokerDice();

$set5Dados = [];
for ($i = 0; $i <= 4; $i++) {
    $set5Dados[] = clone($dado);
}
$jugada = []; // $jugada almacenará el outcome de un lanzamiento de 5 dados : $set5Dados.
$jugadas = []; // $almacenará todos los outcomes de cada lanzamiento de los 5 dados.

$opcion = -1; // entrada del usuario, menú principal

do {
    echo "\nMenú de usuario :\n[1] Presentación del dado de Poker Dice y las funciones \"throwDice\" y \"shapeName\".\n[2] Presentación del set de 5 dados y la jugada.\n[3] Practica el lanzamiento y almacena los resultados con \"getTotalThrows\".\n[0] Salir.\n\n";
    $opcion = (int) readline("Que opción escoges? (1 al 3, salir : 0)\n");
    switch ($opcion) {
        case 1 :
            echo "\nOs presentamos el dado usado en PokerDice :\n";
            var_dump ($dado);
            echo "\nVamos a lanzarlo, veamos como ha cambiado el orden de las caras del dado :\n";
            $dado->throwDice();
            var_dump ($dado);
            echo "\nEl resultado del lanzamiento será la cara que corresponde a la posición [0] :\n";
            echo $dado->shapeName();
            echo "\n\n";
            break;
        case 2 :
            echo "En cada jugada de \"Poker Dice\" deben lanzarse 5 dados.\nPresentamos el set para que comprobéis las caras (el set se desprecinta delante del jugador, su peso y centro de gravedad están certificados) :\n";
            echo "\n";
            var_dump($set5Dados);
            echo "\n\n";
            echo "Lancemos!!!\n\n";
            for ($i = 0; $i < count($set5Dados); $i++) {
                $set5Dados[$i]->throwDice();
            }
            var_dump($set5Dados);
            echo "\nLa jugada tiene por resultado la posición [0] de cada uno de los 5 dados :\n";
            for ($i = 0; $i < count($set5Dados); $i++) {
                $jugada[] = $set5Dados[$i]->shapeName();
            }
            echo "\n";
            print_r($jugada);
            echo "\n";
            break;
        case 3 :
            // Crear la clase Jugador que tenga por atributos $nombre, $set5Dados y $jugadas[], además del método getTotalThrows.
            // Hacer el juego creando X instancias de la clase Jugador y ejecutando getTotalThrouws en un foreach del array de estas instancias.
            echo "Ya sabes como funcionan el objeto \"dado\" y el array \"set5dados\" que almacena 5 clones de \"dado\", así como los métodos \"throwDice\" y \"shapeName\" de la Clase PokerDice.\n";
            echo "Ahora usaremos el método \"getTotalThrows\" que te permitirá lanzar las veces que quieras y te mostrará el total de lanzamientos y su resultado.\n";
            echo "DEBERES : modificarlo para un juego de X jugadores\n\n";
            getTotalThrows($set5Dados);
            echo "\n\n";
            break;
        case 0 :
            echo "Salida del sistema.\n";
            echo "\n\n";
            break;
        default :
        echo "Debes seleccionar una opción válida.\n";
            echo "\n\n";
            break;
    }
} while ($opcion != 0);



function getTotalThrows($set5Dados) {
    do {
        $jugar = (int) readline("Quieres lanzar los dados?\n[1] Si\n[0] No\n");
        unset($jugada);
        switch ($jugar) {
            case 0 :
                echo "\nEsperamos que hayas tenido suerte, hasta la próxima!!\n";
                break;
            case 1 :
                for ($i = 0; $i < count($set5Dados); $i++) {
                    $set5Dados[$i]->throwDice();
                    $jugada[] = $set5Dados[$i]->shapeName();
                }
                $jugadas[] = $jugada;
                break;
            default :
                echo "Debes seleccionar una opción válida.\n\n";
                break;
        }
    } while ($jugar!= 0);
    
    echo "\nHas lanzado los 5 dados un total de " . count($jugadas) . " veces.\n\n";
    echo "El resultado de los " . count($jugadas) . " lanzamientos del set de 5 dados :\n\n";
    print_r($jugadas);
}

?>