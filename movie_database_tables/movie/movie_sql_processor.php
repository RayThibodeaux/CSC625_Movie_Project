<?php 

session_start();
require($_SERVER['DOCUMENT_ROOT'].'/movie_project/mssql_connection.php');
global $MSSQL_CONNECTION;

// GETS
(isset($_GET['header_movie_id'])) ? $header_movie_id = $_GET['header_movie_id'] : $header_movie_id = ''; 
(isset($_GET['header_movie_award_id'])) ? $header_movie_award_id = $_GET['header_movie_award_id'] : $header_movie_award_id = '';
(isset($_GET['mode'])) ? $mode = $_GET['mode'] : $mode = ''; 

// POSTS
(isset($_POST['movieID'])) ? $movie_id = $_POST['movieID'] : $movie_id = '';
(isset($_POST['movieTitle'])) ? $movie_title = $_POST['movieTitle'] : $movie_title = '';
(isset($_POST['movieDesc'])) ? $movie_desc = $_POST['movieDesc'] : $movie_desc = '';
(isset($_POST['movieGenreID'])) ? $movie_genre_id = $_POST['movieGenreID'] : $movie_genre_id = '';
(isset($_POST['movieReleaseDate'])) ? $movie_release_date = $_POST['movieReleaseDate'] : $movie_release_date = '';
(isset($_POST['movieRating'])) ? $movie_rating = $_POST['movieRating'] : $movie_rating = '';
// #########################################################################################
// POST Variables

if(isset($mode))
{
    switch($mode)
    {
        case 'insert':
            global $MSSQL_CONNECTION;

            $movie_name = strtoupper($movie_name);

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
            $sql .= "WHERE MOVIE_ID = ? ";

            // Prepare statement
            $stmt = sqlsrv_prepare($MSSQL_CONNECTION, $sql, array(&$movie_id));

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

            $sql = "UPDATE MOVIE SET TITLE = ?, DESCRIPTION = ?, GENRE_ID = ?,
                RELEASE_DATE = ?, RATING = ? WHERE MOVIE_ID = ?";
            
            // Prepare sql
            $stmt = sqlsrv_prepare($MSSQL_CONNECTION, $sql, array(&$movie_id, &$movie_title, &$movie_desc, &$movie_genre_id, &$movie_release_date, &$movie_rating));

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