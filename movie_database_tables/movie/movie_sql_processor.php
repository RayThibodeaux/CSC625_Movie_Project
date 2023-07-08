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
(isset($_POST['movieName'])) ? $movie_name = $_POST['movieName'] : $movie_name = '';
(isset($_POST['movieAwardID'])) ? $movie_award_id = $_POST['movieAwardID'] : $movie_award_id = '';
// #########################################################################################
// POST Variables

if(isset($mode))
{
    switch($mode)
    {
        case 'insert':
            global $MSSQL_CONNECTION;

            $movie_name = strtoupper($movie_name);

            $sql = "INSERT INTO movie (movie_ID, movie_NAME, movie_AWARD_ID)";
            $sql .= "VALUES (?,?,?)";

            // Prepare sql statement
            $stmt = sqlsrv_prepare($MSSQL_CONNECTION, $sql,array(&$movie_id, &$movie_name, &$movie_award_id));

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

            $sql = "DELETE FROM movie ";
            $sql .= "WHERE movie_ID = ? ";
            $sql .= "AND movie_AWARD_ID = ?";

            // Prepare statement
            $stmt = sqlsrv_prepare($MSSQL_CONNECTION, $sql, array(&$header_movie_id, &$header_movie_award_id));

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

            $sql = "UPDATE movie SET movie_NAME = ?, movie_AWARD_ID = ? WHERE movie_ID = ?";
            
            // Prepare sql
            $stmt = sqlsrv_prepare($MSSQL_CONNECTION, $sql, array(&$movie_name, &$movie_award_id, &$movie_id));

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