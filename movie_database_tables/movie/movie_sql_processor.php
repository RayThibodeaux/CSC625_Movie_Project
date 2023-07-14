<?php 

session_start();
require($_SERVER['DOCUMENT_ROOT'].'/movie_project/mssql_connection.php');
global $MSSQL_CONNECTION;

// GETS
(isset($_GET['header_movie_id'])) ? $header_movie_id = $_GET['header_movie_id'] : $header_movie_id = ''; 
(isset($_GET['mode'])) ? $mode = $_GET['mode'] : $mode = ''; 

// POSTS
(isset($_POST['movieID']))          ? $movie_id =           $_POST['movieID'] : $movie_id = '';
(isset($_POST['movieTitle']))       ? $movie_title =        $_POST['movieTitle'] : $movie_title = '';
(isset($_POST['movieDesc']))        ? $movie_desc =         $_POST['movieDesc'] : $movie_desc = '';
(isset($_POST['movieGenreID']))     ? $movie_genre_id =     $_POST['movieGenreID'] : $movie_genre_id = '';
(isset($_POST['movieReleaseDate'])) ? $movie_release_date = $_POST['movieReleaseDate'] : $movie_release_date = '';
(isset($_POST['movieRating']))      ? $movie_rating =       $_POST['movieRating'] : $movie_rating = '';
// #########################################################################################
// POST Variables

if(isset($mode))
{
    switch($mode)
    {
        case 'insert':
            global $MSSQL_CONNECTION;
            $movie_title = strtoupper($movie_title);
            $movie_desc = strtoupper($movie_desc);

            $sql = "INSERT INTO MOVIE (MOVIE_ID, TITLE, DESCRIPTION, GENRE_ID, RELEASE_DATE, RATING)";
            $sql .= "VALUES (?,?,?,?,?,?)";

            // Prepare sql statement
            $stmt = sqlsrv_prepare($MSSQL_CONNECTION, $sql,array(&$movie_id, &$movie_title, &$movie_desc, &$movie_genre_id, &$movie_release_date, &$movie_rating));

            // Execute statement
            if(sqlsrv_execute($stmt) === false)
            {
                die(print_r(sqlsrv_errors(), true));
            }

            // Clean up resources
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($MSSQL_CONNECTION);
            break;

        case 'delete':
            global $MSSQL_CONNECTION;

            $sql = "DELETE FROM MOVIE ";
            $sql .= "WHERE MOVIE_ID = ?";

            // Prepare statement
            $stmt = sqlsrv_prepare($MSSQL_CONNECTION, $sql, array(&$header_movie_id));

            // Execute statement
            if(sqlsrv_execute($stmt) === false)
            {
                die(print_r(sqlsrv_errors(), true));
            }

            // Clean up resources
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($MSSQL_CONNECTION);
            break;

        case 'update':
            global $MSSQL_CONNECTION;

            if(!empty($movie_title)){ $updates[] =  'TITLE = '."'".strtoupper($movie_title)."'"; }
            if(!empty($movie_desc)){ $updates[] = 'DESCRIPTION = '."'".strtoupper($movie_desc)."'"; }
            if(!empty($movie_genre_id)){ $updates[] = 'GENRE_ID = '."'$movie_genre_id'"; }
            if(!empty($movie_release_date)){ $updates[] = 'RELEASE_DATE = '."'$movie_release_date'"; }
            if(!empty($movie_rating)){ $updates[] = 'RATING = '."'$movie_rating'"; }

            if(!empty($updates))
            {
                $sql = 'UPDATE MOVIE SET '.implode(',',$updates).' WHERE MOVIE_ID = '. $_GET['header_movie_id'];
            }
            // Prepare sql
            $stmt = sqlsrv_prepare($MSSQL_CONNECTION, $sql);
            // Execute sql
            if(sqlsrv_execute($stmt) === false)
            {
                die(print_r(sqlsrv_errors(), true));
            }

            // Clean up resources
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($MSSQL_CONNECTION);
            break;
    }
}

?>