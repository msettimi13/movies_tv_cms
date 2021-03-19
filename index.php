<?php
    require_once 'load.php';
    
    if(isset($_GET['filter'])){
        $filter = $_GET['filter'];
        $getMovies = getMoviesByGenre($filter);
    } else {
        $getMovies = getAllMovies();
    }

    echo json_encode($getMovies);

