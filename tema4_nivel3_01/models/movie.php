<?php
declare(strict_types=1);
require_once "director.php";
require_once "admin.php";

$moviesPath = __DIR__ . '/../db/movies.json';
$directorsPath = __DIR__ . '/../db/directors.json';


class Movie {
    protected int $id_movie;
    protected string $title;
    protected int $director_id;
    protected int $runtime; // length of the movie in minutes
    protected string $poster;

    function __construct($title, $director_id, $runtime, $poster = null) {
        $this->title = $title;
        $this->director_id = $director_id;
        $this->runtime = $runtime;
        if($poster){$this->poster = rtrim(__DIR__, '/') . '/../img/' . $poster;}
    }

    // Getters

    public function getIdMovie() : int {
        return $this->id_movie;
    }

    public function getTitle() : string {
        return $this->title;
    }

    public function getDirectorId() : int {
        return $this->director_id;
    }

    public function getRuntime() : int {
        return $this->runtime;
    }

    public function getPoster() : string {
        return $this->poster;
    }

    // Setters

    public function setIdMovie($id_movie) : void {
        $this->id_movie = $id_movie;
    }

    public function setTitle($title) : void {
        $this->title = $title;
    }

    public function setDirector($director) : void {
        $this->director = $director;
    }

    public function setRuntime($runtime) : void {
        $this->runtime = $runtime;
    }

    public function setPoster($poster) : void {
        $this->poster = rtrim(__DIR__, '/') . '/../img/' . $poster;
    }

    
    // Serialize instance to save in json persistence file

    public function toArray() : array {
        return [
            'id_movie' => $this->id_movie,
            'title' => $this->title,
            'director_id' => $this->director_id,
            'runtime' => $this->runtime
        ];
    }

    // ABOUT MOVIE : toString

    public function __toString() {
        $hours = intdiv($this->runtime, 60);
        $minutes = $this->runtime % 60;

        $admin = new Admin();

        $director = $admin->getDirectorById($this->director_id);
        $director_name = $director->getDirectorName();

        return "[ID $this->id_movie] Title : $this->title | Director : $director_name | Runtime : {$hours}h {$minutes}m";
    }
}
?>