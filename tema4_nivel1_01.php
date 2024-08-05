<?php
//RECURSO : https://diego.com.es/modificadores-y-herencia-de-clases-en-php

class Employee {
    protected $name; // "private" no permite acceso a los descendientes, no podemos usar este modificador, sólo "public" y "protected"
    protected $salary; // "protected" permite que las clases child accedan y modifiquen sin problema el valor de este atributo

    // Constructor

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

    // Método general

    public function echoInfo(){
        $taxes = ($this->salary > 12000)? "debe pagar impuestos (su remuneración anual excede los 12.000 €)" : "NO debe pagar impuestos (su remuneración anual no alcanza los 12.000 €).";
        if ($this->salary > 0) {
            echo "El empleado $this->name gana $this->salary € al año; por lo tanto, " . $taxes;
        } else {
            echo "El empleado $this->name no tiene un salario asignado.";
        }
    }
}

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

echo"\n\n";
echo "Rubén : a partir del Nivel 2 (ya hice el Nivel 1), te presentaré las Clases en archivos distintos y usaré \"require()\".\n";

$frank = new Employee("Frank", 5000); // Esta instrucción da error al declarar la instancia sin atributos para pasarlos luego con sets...
// $frank->setName("Frank"); // Al crear el objeto sin pasarle atributos para hacer posteriormente el set no funciona (FATAL ERROR). Supongo que hay que
// $frank->setSalary(5000); // crear un segundo constructor sin atributos.
$frank->echoInfo();

echo"\n";
$pedro = new InternshipStudent("Pedro Pérez", "Informática"); // No asigno valor al atributo $this->salary. Tomará '0'.
$pedro->echoInfoStudent();


// Función instanceof (boolean)
echo "\n\n";
echo "Usando la función instanceof para distinguir entre clases CHILD :\n";
if ($frank instanceof Employee) {echo ($frank instanceof Employee) . ' (1 = TRUE = cierto), $frank es una objeto/instancia de la Clase Employee.';}
echo "\n";
if ($pedro instanceof InternshipStudent) {echo ($pedro instanceof InternshipStudent) . ' (1 = TRUE = cierto), $pedro es objeto/instancia de la Clase InternshipStudent';}
echo "\n";
echo 'Ojo : tanto usar print_r($array) me ha hecho olvidar la función var_dump';

?>