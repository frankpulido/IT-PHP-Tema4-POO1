<?php

/*
Frank Pulido - Tema 4 [POO1] - Nivel 1 - Ejercicio 2

ENUNCIADO :
Escribe un programa que defina una clase Shape con un constructor que reciba como parámetros el ancho y alto.
Define dos subclases; Triángulo y Rectángulo que hereden de Shape y que calculen respectivamente el área de la forma area().

RECURSOS :
Clase padre : OJO protected versus private, etc, no lo tengo 100% claro. La primera se usa en ejemplo de "interface" :
https://diego.com.es/modificadores-y-herencia-de-clases-en-php
https://medium.com/@london.lingo.01/exploring-the-power-of-php-object-oriented-programming-4516980fd95b
*/

abstract class Shape { // Obligaré a los CHILD a usar la función area(). Para poder declarar métodos abstract la Clase debe ser abstract.
    protected $base;
    protected $height;

    public function __construct($base, $height) {
        $this->base = $base;
        $this->height = $height;
    }

    // Getters

    public function getBase() {
        return $this->base;
    }

    public function getHeight() {
        return $this->height;
    }

    // Setters

    public function setBase($base) {
        $this->base = $base;
    }

    public function setHeight($height) {
        $this->height = $height;
    }


    // Función área que sobreescribiremos en las clases hijas

    abstract function area(); // El método abstract únicamente se declara. Se desarrollara en sus CHILD

}

class Rectangle extends Shape { // Al ser Shape una clase "abstract", el método "area" es obligatorio

    // Atributo adicional... El resto los hereda de la Clase Shape (parent)...
    protected $name;

    public function __construct($base, $height, $name = 'Rectángulo') {
        Shape::__construct($base, $height);
        $this->name = $name;
    }

    public function area() {
        echo "El área del " . $this->name . " es el producto de su base por su altura.\n";
        echo $this->base . " * " . $this->height . " = " . $this->base * $this->height;
    }
}

class Triangle extends Shape { // Al ser Shape una clase "abstract", el método "area" es obligatorio

    // Atributo adicional... El resto los hereda de la Clase Shape (parent)...
    protected $name = "Triángulo";

    public function __construct($base, $height, $name = 'Triángulo') {
        Shape::__construct($base, $height);
        $this->name = $name;
    }

    public function area () {
        echo "El área del " . $this->name . " es el producto de su base por su altura dividido entre 2.\n";
        echo $this->base . " * " . $this->height . " / 2 = " . ($this->base * $this->height) / 2;
    }
}

echo "\n";
echo "Rubén : a partir del Nivel 2 (siguiente ejercicio), te presentaré las Clases en archivos distintos y usaré \"require()\".\n";
echo "Vamos a calcular el área de 2 figuras geométricas sencillas : rectánculo y triángulo.\nPara ello necesitaremos que nos indique base y altura (usaremos los mismos valores en ambos casos).\n";
$base = (float) readline("Por favor, indíquenos la base : ");
$height = (float) readline("Por favor, indíquenos la altura : ");
$triangulo = new Triangle ($base, $height);
$rectangulo = new Rectangle ($base, $height);
echo "\n";
$triangulo->area();
echo "\n";
$rectangulo->area();
echo "\n";
echo "Si la base y la altura miden igual, el área del triángulo será siempre la mitad que la del rectángulo, independientemente de que el triángulo tenga o no un ángulo recto.\n";
echo "Dibuja el triángulo en el interior del rectángulo y sombrea su área... Lo ves?...";

?>