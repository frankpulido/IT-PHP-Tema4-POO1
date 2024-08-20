<?php
class Movie {
    private $title;
    private $director;
    private $hours;
    private $minutes;
    private $length;

    function __construct($title, $director, $hours, $minutes) {
        $this->title = $title;
        $this->director = $director;
        $this->hours = $hours;
        $this->minutes = $minutes;
    }

    // Getters
    public function getTitle() {
        return $this->title;
    }
    public function getDirector() {
        return $this->director;
    }
    public function getLength() {
        return $this->length;
    }

    // Setters
    public function setTitle($title) {
        $this->title = $title;
    }
    public function setDirector($director) {
        $this->director = $director;
    }
    public function setLength() {
        $this->length = $this->hours * 60 + $this->minutes;
    }

    // Función About

    public function aboutMovie() {
        $this->setLength();
        return "Título : $this->title / Director : $this->director / Duración : (" . $this->hours . "h:" . $this->minutes . "') $this->length minutos";
    }
}
?>