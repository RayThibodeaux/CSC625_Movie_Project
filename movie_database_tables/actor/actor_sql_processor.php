    <?php 

    session_start();
    require($_SERVER['DOCUMENT_ROOT'].'/movie_project/mssql_connection.php');
    global $MSSQL_CONNECTION;

    // GETS
    (isset($_GET['header_actor_id'])) ? $header_actor_id = $_GET['header_actor_id'] : $header_actor_id = ''; 
    (isset($_GET['header_actor_award_id'])) ? $header_actor_award_id = $_GET['header_actor_award_id'] : $header_actor_award_id = '';
    (isset($_GET['mode'])) ? $mode = $_GET['mode'] : $mode = ''; 

    // POSTS
    (isset($_POST['actorID'])) ? $actor_id = $_POST['actorID'] : $actor_id = '';
    (isset($_POST['actorName'])) ? $actor_name = $_POST['actorName'] : $actor_name = '';
    (isset($_POST['actorAwardID'])) ? $actor_award_id = $_POST['actorAwardID'] : $actor_award_id = '';
    // #########################################################################################
    // POST Variables

    if(isset($mode))
    {
        switch($mode)
        {
            case 'insert':
                global $MSSQL_CONNECTION;

                $actor_name = strtoupper($actor_name);

                $sql = "INSERT INTO ACTOR (ACTOR_ID, ACTOR_NAME, ACTOR_AWARD_ID)";
                $sql .= "VALUES (?,?,?)";

                // Prepare sql statement
                $stmt = sqlsrv_prepare($MSSQL_CONNECTION, $sql,array(&$actor_id, &$actor_name, &$actor_award_id));

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

                $sql = "DELETE FROM ACTOR ";
                $sql .= "WHERE ACTOR_ID = ? ";
                $sql .= "AND ACTOR_AWARD_ID = ?";

                // Prepare statement
                $stmt = sqlsrv_prepare($MSSQL_CONNECTION, $sql, array(&$header_actor_id, &$header_actor_award_id));

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

                $sql = "UPDATE ACTOR SET ACTOR_NAME = ?, ACTOR_AWARD_ID = ? WHERE ACTOR_ID = ?";
                
                // Prepare sql
                $stmt = sqlsrv_prepare($MSSQL_CONNECTION, $sql, array(&$actor_name, &$actor_award_id, &$actor_id));

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