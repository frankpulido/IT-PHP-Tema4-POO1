<?php
class movieTheather {
    private $name;
    private $location;
    private $showing = [];

    function __construct($name, $location) {
        $this->name = $name;
        $this->location = $location;
    }

    // Getters

    public function getName() {
        return $this->name;
    }
    public function getLocation() {
        return $this->location;
    }
    public function getShowing() {
        return $this->showing;
    }

    // Setters

    public function setName($name) {
        $this->name = $name;
    }
    public function setLocation($location) {
        $this->location = $location;
    }
    public function setShowing($showing) {
        $this->showing = $showing;
    }
}
?>