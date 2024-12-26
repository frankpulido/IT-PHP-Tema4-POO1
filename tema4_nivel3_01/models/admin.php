<?php
declare(strict_types=1);
require_once "director.php";
require_once "movie.php";
require_once "theater.php";

class Admin {
    protected $moviesPath = __DIR__ . '/../db/movies.json';
    protected $directorsPath = __DIR__ . '/../db/directors.json';
    protected $theatersPath = __DIR__ . '/../db/theaters.json';

    protected array $directors;
    protected array $movies;
    protected array $theaters;

    public function __construct() {
        $this->directors = self::getAll($this->directorsPath);
        $this->movies = self::getAll($this->moviesPath);
        $this->theaters = self::getAll($this->theatersPath);
    }

    // Getters

    public function getDirectors() : array {
        return $this->directors;
    }

    public function getMovies() : array {
        return $this->movies;
    }

    public function getTheaters() : array {
        return $this->theaters;
    }

    // "Update" setters... Not usual "setters" since we feed attributes from json persistence files

    public function updateDirectors() : void {
        $this->directors = self::getAll($this->directorsPath);
    }

    public function updateMovies() : void {
        $this->movies = self::getAll($this->moviesPath);
    }

    public function updateTheaters() : void {
        $this->theaters = self::getAll($this->theatersPath);
    }

    // HELPER METHOD TO GENERATE UNIQUE ID's FOR NEW INSTANCES

    private function generateUniqueId(string $filePath, string $idKey): int {
        $data = $this->getAll($filePath);
        if (!empty($data)) {
            $ids = array_map(fn($task) => (int)$task[$idKey], $data);
            $maxId = max($ids); // Find the highest ID
            return $maxId + 1;  // Increment by 1
        }
        return 1; // Start from 1 if no data exists
    }


    // HELPER METHOD TO PEOPLE ATTRIBUTES RETRIEVING DATA FROM JSON PERSISTENCE FILES

    public  function getAll($path): array {
        if (!file_exists($path)) {return [];}
        $jsondocuments = json_decode(file_get_contents($path), true);
        if ($jsondocuments === null) {return [];}
        return $jsondocuments;
    }

    // GET BY ID (Director/Movie/Theater) RETRIEVING DOCUMENT FROM JSON PERSISTENCE FILE

    public function getDirectorById (int $director_id) : ?Director {
        $directors = $this->directors;

        foreach ($directors as $director) {
            if($director['id_director'] === $director_id) {
                $directorObject = new Director(
                    $director['director_name']
                );
                $directorObject->setDirectorId($director['id_director']);
                return $directorObject;
            }
        }
        return null; // Director not found
    }

    public function getMovieById (int $movie_id) : ?Movie {
        $movies = $this->movies;

        foreach ($movies as $movie) {
            if ($movie['id_movie'] === $movie_id) {
                $movieObject = new Movie(
                    $movie['title'],
                    $movie['director_id'],
                    $movie['runtime']
                );
                $movieObject->setIdMovie($movie['id_movie']);
                return $movieObject;
            }
        }
        return null; // Movie not found
    }

    public function getTheaterById ($theater_id) : ?MovieTheater {
        $theaters = $this->theaters;

        foreach ($theaters as $theater) {
            if ($theater['id_theater'] === $theater_id) {
                $theaterObject = new MovieTheater(
                    $theater['name'],
                    $theater['city'],
                    $theater['screens'],
                    $theater['showing']
                );
                $theaterObject->setIdTheater($theater['id_theater']);
                return $theaterObject;
            }
        }
        return "Theater ID not found!!";
    }

    // METHODS TO SAVE NEW INSTANCES INTO THEIR JSON PERSISTENCE FILES

    public function saveMovieToJson($movie): void {
        $movies = $this->movies;
        // Add new movie instance
        $movies[] = $movie->toArray();
        // Save back to file
        file_put_contents($this->moviesPath, json_encode($movies, JSON_PRETTY_PRINT));
    }

    public function saveTheaterToJson($theater): void {
        $theaters = $this->theaters;
        // Add new movie instance
        $theaters[] = $theater->toArray();
        // Save back to file
        file_put_contents($this->theatersPath, json_encode($theaters, JSON_PRETTY_PRINT));
    }
    
    public function saveDirectorToJson($director): void {
        $directors = $this->directors;
        // Add new movie instance
        $directors[] = $director->toArray();
        // Save back to file
        file_put_contents($this->directorsPath, json_encode($directors, JSON_PRETTY_PRINT));
    }

    public function createMovie(array $movieData){
        // Array must be created in this format  : $movieData = ['title'=>$title, 'director_id'=>$director_id, 'runtime'=>$runtime];
        $movie = new Movie(
            $movieData['title'],
            (int) $movieData['director_id'],
            (int) $movieData['runtime']
        );
        $uniqueId = $this->generateUniqueId($this->moviesPath, 'id_movie');
        $movie->setIdMovie($uniqueId);
        //$this->movies[] = $movie->toArray();
        $this->saveMovieToJson($movie);
        $this->updateMovies();
        return $movie;
    }

    public function createDirector(array $directorData){
        // Array must be created in this format : $directorData = ['director_name' => $director_name];
        $director = new Director(
            $directorData['director_name']
        );
        $uniqueId = $this->generateUniqueId($this->directorsPath, 'id_director');
        $director->setDirectorId($uniqueId);
        //$this->movies[] = $movie->toArray();
        $this->saveDirectorToJson($director);
        $this->updateDirectors();
        return $director;
    }

    public function higherLength($theater_id) {
        $theater = $this->getTheaterById($theater_id);
        $movies_showing = $theater->getShowing();
        $higher_length = 0;
        $reply = null;
        foreach($movies_showing as $id) {
            $length = $this->getMovieById($id)->getRuntime();
            if($length > $higher_length) {
                $higher_length = $length;
                $reply = $id;
            }
        }
        return $this->getMovieById($reply);
    }
    
    public function allFromDirector($director_id) {
        $theaters = $this->theaters;
        $movies = [];
        $reply = "";
        foreach($theaters as $theater) {
            $movies = array_merge($movies, $theater['showing']);
        }
        $movies = array_count_values($movies);
        foreach($movies as $id=>$frequency) {
            if($this->getMovieById($id)->getDirectorId() != $director_id) {
                unset($movies[$id]);
            }
        }
        if(count($movies) >= 1) {
            foreach($movies as $id=>$frecuency) {
                $reply = $reply . $this->getMovieById($id) . " (ON SCREEN NOW in " . $frecuency . " Movie Theaters)" . PHP_EOL;
            }
        } else { return "There are not any movies from that Director at the moment."; }
        return $reply;
    }

    public function addMovieToShowing($id_movie, $id_theater) {
        $theater = $this->getTheaterById($id_theater)->toArray();
        if(in_array($id_movie, $theater['showing'])) {
            return "Movie is already on screen in this Movie Theater.";
        }
        else {
            if($theater['screens'] > count($theater['showing'])) {
                $new_showing = $theater['showing'];
                $new_showing[] = $id_movie;
                $theaters = $this->theaters;
                foreach($theaters as $theater) {
                    if ($theater['id_theater'] == $id_theater) {
                        $theater['showing'] = $new_showing;
                    }
                }
                file_put_contents($this->theatersPath, json_encode($theaters, JSON_PRETTY_PRINT));
                return "Movie successfully added ON SCREEN." . PHP_EOL . $this->getTheaterById($id_theater);
            }
            return "All screens have a Movie assigned, you have to eliminate a Movie from screen before adding a new one.";
        }
    }

    public function removeMovieFromShowing($id_movie, $id_theater) {
        echo "Still to develop : remove movie ID $id_movie from screen in theater ID $id_theater";
    }

    function menuDirectors() {
        $directors = $this->directors;
        $reply = "";
        foreach($directors as $director) {
            $reply = $reply . "[ID : " . $director['id_director'] . "] " . $director['director_name'] . PHP_EOL;
        }
        return $reply;
    }
    
    function menuMovies() {
        $movies = $this->movies;
        $reply = "";
        foreach($movies as $movie) {
            $reply = $reply . "[ID : " . $movie['id_movie'] . "] " . $movie['title'] . PHP_EOL;
        }
        return $reply;
    }
    
    function menuTheaters() {
        $theaters = $this->theaters;
        $reply = "";
        foreach($theaters as $theater) {
            $reply = $reply . "[ID : " . $theater['id_theater'] . "] " . $theater['name'] . PHP_EOL;
        }
        return $reply;
    }
    
}
?>