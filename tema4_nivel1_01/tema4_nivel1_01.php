<?php
/*
Frank Pulido - Tema 4 [POO1] - Nivel 1 - Ejercicio 1

ENUNCIADO :
Crea una clase Employee, define como atributos su nombre y sueldo. Definir un método initialize que reciba como parámetros el nombre y sueldo.
Plantear un segundo método print que imprima el nombre y un mensaje si debe pagar o no impuestos (si el sueldo supera 6000, paga impuestos).

RECURSOS :
https://diego.com.es/modificadores-y-herencia-de-clases-en-php
*/

class Employee {
    protected $name; // "private" no permite acceso a los descendientes, no podemos usar este modificador, sólo "public" y "protected"
    protected $salary; // "protected" permite que las clases child accedan y modifiquen sin problema el valor de este atributo

    // Constructor : Método "Initialize"

    function __construct($name, $salary) {
        $this->name = $name;
        $this->salary = $salary;
    }

    // Setters

    public function setName($name) {
        $this->name = $name;
    }
    
    public function setSalary($salary) {
        $this->salary = $salary;
    }

    // Getters

    public function getName() {
        return $this->name;
    }

    public function getSalary() {
        return $this->salary;
    }

    // Método general : "Print"

    public function echoInfo(){
        $taxes = ($this->salary > 12000)? "debe pagar impuestos (su remuneración anual excede los 12.000 €)" : "NO debe pagar impuestos (su remuneración anual no alcanza los 12.000 €).";
        if ($this->salary > 0) {
            echo "El empleado $this->name gana $this->salary € al año; por lo tanto, " . $taxes;
        } else {
            echo "El empleado $this->name no tiene un salario asignado.";
        }
    }
}

# Hice la clase CHILD que vi en un ejemplo del material de estudio...

class InternshipStudent extends Employee {

    // Atributos (no heredados de parent)
    private $department;

    // Constructor
    public function __construct($name, $department, $salary='0') { // Los parámetros opcionales hay que declararlos al final o da error, no ha de respetarse el orden del constructor PARENT.
        Employee::__construct($name, $salary);
        $this->department = $department;
    }

    // SETTER & GETTER del nuevo atributo

    public function setDepartment($department) {
        $this->department = $department;
    }

    public function getDepartment() {
        return $this->department;
    }

    // Sobreescritura de la función heredada
    public function echoInfoStudent(){
        Employee::echoInfo(); // Esta instrucción no era necesaria. El método de la clase Employee no es Abstract (y por lo tanto la Clase parent tampoco).
        echo "\n" . $this->name . " ha sido contratado como estudiante de prácticas en el departamento de " . $this->department . ". Los estudiantes hacen prácticas NO remuneradas.";
    }
}

echo"\n";
echo "Rubén : a partir del Nivel 2 (ya hice el Nivel 1), te presentaré las Clases en archivos distintos y usaré \"require()\".\n\n";

$frank = new Employee("Frank", 5000); // Esta instrucción da error al declarar la instancia sin atributos para pasarlos luego con sets...
// No he probado a hacer múltiples constructores. Supongo que debemos crear un segundo constructor sin atributos... Orden? (menos a más?)
$frank->echoInfo();

echo"\n\n";
$pedro = new InternshipStudent("Pedro Pérez", "Informática"); // No asigno valor al atributo $this->salary. Tomará '0'.
$pedro->echoInfoStudent();


// Función instanceof (boolean)
echo "\n\n";
echo "Usando la función instanceof para distinguir entre Clases :\n";
if ($frank instanceof Employee) {echo ($frank instanceof Employee) . ' (1 = TRUE = cierto), $frank es una objeto/instancia de la Clase Employee.';}
echo "\n";
if ($pedro instanceof InternshipStudent) {echo ($pedro instanceof InternshipStudent) . ' (1 = TRUE = cierto), $pedro es objeto/instancia de la Clase InternshipStudent';}

?>