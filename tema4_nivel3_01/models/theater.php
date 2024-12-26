<?php
declare(strict_types=1);
require_once "movie.php";

class MovieTheater {
    protected int $id_theater;
    protected string $name;
    protected string $city;
    protected int $screens;
    protected array $showing;

    function __construct(string $name, string $city, int $screens, array $showing = null) {
        $this->name = $name;
        $this->city = $city;
        $this->screens = $screens;
        $this->showing = $showing;
    }

    /*
    public function initShowing() {
        for ($i = 1; $i <= $this->screens; $i++) {
            $this->showing["screen_$i"] = null;
        }
    }
    // Escalate : Create Class Screen to add seats and calendar : online selling
    */

    // Getters

    public function getIdTheater() : int {
        return $this->id_theater;
    }

    public function getName() : string {
        return $this->name;
    }
  
    public function getCity() : string {
        return $this->city;
    }

    public function getScreens() : int {
        return $this->screens;
    }
  
    public function getShowing() : array {
        return $this->showing;
    }

    // Setters

    public function setIdTheater($id_theater) : void {
        $this->id_theater = $id_theater;
    }

    public function setName($name) : void {
        $this->name = $name;
    }

    public function setCity($city) : void {
        $this->city = $city;
    }

    public function setScreens($screens) : void { // When changing $this->screens we also have to change $this->showing... If screens are reduced some movies will not longer be in showing, otherwise they will all be set and additional new screens will be set null.
        $this->screens = $screens;
        $showing = $this->getShowing();
        if(isset($this->showing)){
            for ($i = 1; $i<=$screens; $i++) {
                if($i <= count($showing)) {$this->showing[] = $showing[$i];} 
                else {$this->showing[] = null;}
            }
        }
    }

    public function setShowing($showing) : void {
        $this->showing = $showing;
    }

    // Serialize instance to save in json persistence file

    public function toArray() : array {
        return [
            'id_theater' => $this->id_theater,
            '$name' => $this->name,
            'city' => $this->city,
            'screens' => $this->screens,
            'showing' => $this->showing
        ];
    }

    // ABOUT THEATER : __toString()

    public function __toString() {
        $movies = $this->showing;
        $moviesinfo = "";

        $admin = new Admin();

        foreach($movies as $movieId) {
            $moviesinfo = $moviesinfo . $admin->getMovieById($movieId) . PHP_EOL;
        }
        return "Theater : $this->name | Location : $this->city" . " | Showing (". count($movies)."): " . PHP_EOL . $moviesinfo;
    }
}
?>