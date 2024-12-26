<?php
declare(strict_types=1);

class Director {
    protected int $id_director;
    protected string $director_name;


    function __construct($director_name) {
        $this->director_name = $director_name;
    }

    // Getters

    public function  getIdDirector() : int {
        return $this->id_director;
    }

    public function getDirectorName() : string {
        return $this->director_name;
    }

    // Setters

    public function setDirectorId($id_director) : void {
        $this->id_director = $id_director;
    }

    public function setDirectorName($director_name) : void {
        $this->director_name = $director_name;
    }

    // Serialize instance to save in json persistence file

    public function toArray() : array {
        return [
            'id_director' => $this->id_director,
            'director_name' => $this->director_name
        ];
    }
    
    // ABOUT DIRECTOR : __toString()

    public function __toString() {
        return "Director : " . $this->director_name . " [ID : " . $this->id_director . "].";
    }
}
?>