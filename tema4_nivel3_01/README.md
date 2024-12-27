# MOVIE THEATERS MANAGER - FRANK PULIDO

At this first stage the app has been developed only for BackEnd use.<br>
It uses JSON persistence files for classes Director, Movie and MovieTheater.<br>

## BACKEND
File indexAdmin.php has the BackEnd menu for using the methods created in Admin class to manage the catalogues and store them as json files.<br>
The engine : Class Admin in models/admin.php.<br>

The BackEnd menu :<br>
Welcome to IT Movie Theaters.<br>
1- Show movies in the selected Movie Theater.<br>
2- Show the movie with higher length in the selected Movie Theater.<br>
3- Show movies ON SCREEN by a given Director (all Movie Theaters).<br>
4- Add movie to catalogue.<br>
5- Add movie on Screen in a Theater of choice.<br>
6- Remove movie from Screen in a Theater of choice.<br>

## FRONTEND
File indexWeb.php (to be developed) will have a simple website displaying all movies in catalogue. For each Movie :
- Poster image
- Integer displaying number of MovieTheaters showing the Movie
- Name and location of the Theaters displaying the Movie

Movie goers visiting the page will be able to use this filters :
- Search Movie by Name
- Search Movies by Director
- Search Movies by MovieTheater

## FUTURE DEVELOPMENT
1) FrontEnd
2) Class Screen<br>
Attribute 'screens' in class MovieTheater will no longer be an array of atrributes 'id_movie' of class Movie.
Attribute 'screens' will be an array of objects Screen.

### CLASS SCREEN
Attributes :
- int $seats : number of seats of the screen.
- array $shows : array of objects of class Show

#### CLASS SHOW
Attributes :
- Date $date
- $session (enum for the sessions of date)
Important : unique($date, $session)
- int $sold : seats already sold ($sold <= $seats)

From this second development stage we can think of scalating the App for online selling.