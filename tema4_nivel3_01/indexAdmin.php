<?php
declare(strict_types=1);

require_once __DIR__ . '/models/admin.php';
$admin = new Admin();

//$movies = $admin->getMovies();
//$directors = $admin->getDirectors();
//$theaters = $admin->getTheaters();

$choice = -1;

do {
    echo PHP_EOL;
    echo "Welcome to IT Movie Theaters.";
    echo PHP_EOL;
    echo menu();
    echo PHP_EOL;
    echo PHP_EOL;
    echo "Enter your choice [1 to 6] or \"0\" to Exit : ";
    $choice = (int)trim(fgets(STDIN));
    echo PHP_EOL;
    switch ($choice) {
        case 0 :
            echo "You have been logged out..." . PHP_EOL;
            break;
        case 1 :
            $option = 0;
            echo "You have chosen to view movies offered in the Movie Theater of your choice. Our theaters :";
            echo PHP_EOL;
            echo $admin->menuTheaters();
            echo PHP_EOL;
            echo "Enter your choice [Theater ID number] : ";
            $option = (int)trim(fgets(STDIN));
            echo PHP_EOL;
            echo $admin->getTheaterById($option);
            echo PHP_EOL;
            break;
        case 2 :
            $theater_id = 0;
            echo "You have chosen to list the Movie of highest runtime in the Movie Theater of your choice. Our theaters : ";
            echo PHP_EOL;
            echo $admin->menuTheaters();
            echo PHP_EOL;
            echo "Enter your choice [Theater ID number] : ";
            $theater_id = (int)trim(fgets(STDIN));
            echo PHP_EOL;
            echo "Movie Theater : " . $admin->getTheaterById($theater_id)->getName() . ". Longest runtime movie :" . PHP_EOL;
            echo $admin->higherLength($theater_id) . PHP_EOL;
            echo PHP_EOL;
            break;
        case 3 :
            $director_id = 0;
            echo "You have chosen to Show movies of a given Director. Our Directors : ";
            echo PHP_EOL;
            echo $admin->menuDirectors();
            echo PHP_EOL;
            echo "Enter your choice [Director ID number] : ";
            $director_id = (int)trim(fgets(STDIN));
            echo PHP_EOL;
            echo "These are the movies by " . $admin->getDirectorById($director_id);
            echo PHP_EOL;
            echo $admin->allFromDirector($director_id);
            echo PHP_EOL;
            break;
        case 4 :
            echo "You have chosen to ADD A MOVIE to the catalogue.";
            echo PHP_EOL;
            echo "TITLE of the Movie : ";
            $title = trim(fgets(STDIN));
            echo "RUNTIME of the Movie in minutes : ";
            $runtime = (int)trim(fgets(STDIN));
            echo PHP_EOL;
            echo "These are the Directors in our database :" . PHP_EOL;
            echo $admin->menuDirectors();
            echo PHP_EOL;
            echo "PRESS \"0\" if it is not in the list to create NEW, otherwise enter Director ID number : ";
            $director_id = (int)trim(fgets(STDIN));
            echo PHP_EOL;
            if($director_id != 0) {
                $movieData = ['title'=>$title, 'director_id'=>$director_id, 'runtime'=>$runtime];
                $movie = $admin->createMovie($movieData);
                echo "NEW movie successfully added to catalogue :" . PHP_EOL . $movie . PHP_EOL;
            }
            else {
                echo "Enter the NEW Director name : ";
                $director_name = trim(fgets(STDIN));
                $directorData = ['director_name' => $director_name];
                $director = $admin->createDirector($directorData);
                echo PHP_EOL;
                echo "NEW director successfully added to database :" . PHP_EOL . $director . PHP_EOL;
                $director_id = $director->getIdDirector();
                $movieData = ['title'=>$title, 'director_id'=>$director_id, 'runtime'=>$runtime];
                $movie = $admin->createMovie($movieData);
                echo "NEW movie successfully added to catalogue :" . PHP_EOL . $movie . PHP_EOL;
            }
            break;
        case 5 :
            $theater_id = 0;
            echo "You have chosen to ADD a Movie ON SCREEN in a Movie Theater of your choice. Our theaters :";
            echo PHP_EOL;
            echo $admin->menuTheaters();
            echo PHP_EOL;
            echo "Enter your choice [Theater ID number] : ";
            $theater_id = (int)trim(fgets(STDIN));
            echo PHP_EOL;
            echo "Movies in our Catalogue :";
            echo PHP_EOL;
            echo $admin->menuMovies();
            echo PHP_EOL;
            echo "Select the Movie you want to add ON SCREEN [Movie ID number] : ";
            $movie_id = (int)trim(fgets(STDIN));
            echo $admin->addMovieToShowing($movie_id, $theater_id) . PHP_EOL;
            break;
        case 6 :
            $theater_id = 0;
            echo "You have chosen to REMOVE a Movie FROM SCREEN in a Movie Theater of your choice. Our theaters :";
            echo PHP_EOL;
            echo $admin->menuTheaters();
            echo PHP_EOL;
            echo "Enter your choice [Theater ID number] : ";
            $theater_id = (int)trim(fgets(STDIN));
            echo PHP_EOL;
            echo $admin->getTheaterById($theater_id);
            echo PHP_EOL;
            echo "Enter your choice of Movie to remove from Screen [Movie ID number] : ";
            $movie_id = (int)trim(fgets(STDIN));
            echo PHP_EOL;
            echo $admin->removeMovieFromShowing($movie_id, $theater_id) . PHP_EOL;
            break;
        default :
            echo "Enter a valid choice [1 to 6] or \"0\" to Exit.";
            break;
    }

} while($choice != 0);
echo PHP_EOL;

function menu() {
    echo "1- Show movies in the selected Movie Theater." . PHP_EOL . "2- Show the movie with higher length in the selected Movie Theater." . PHP_EOL . "3- Show movies ON SCREEN by a given Director (all Movie Theaters)." . PHP_EOL . "4- Add movie to catalogue." . PHP_EOL . "5- Add movie on Screen in a Theater of choice." . PHP_EOL . "6- Remove movie from Screen in a Theater of choice.";
}

?>