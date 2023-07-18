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

                $sql = 'EXEC sp_insert_actor @ACTOR_ID=?,@ACTOR_NAME=?,@ACTOR_AWARD_ID=?';

                // Prepare sql statement
                $sql_stmnt = sqlsrv_prepare($MSSQL_CONNECTION, $sql,array(&$actor_id, &$actor_name, &$actor_award_id));

                // Execute statement
                if(sqlsrv_execute($sql_stmnt) === false)
                {
                    die(print_r(sqlsrv_errors(), true));
                }

                // Clean up resources
                sqlsrv_free_stmt($sql_stmnt);
                sqlsrv_close($MSSQL_CONNECTION);
                break;

            case 'delete':
                global $MSSQL_CONNECTION;

                $sql = 'EXEC sp_delete_actor @ACTOR_ID=?';

                // Prepare statement
                $sql_stmt = sqlsrv_prepare($MSSQL_CONNECTION, $sql, array(&$header_actor_id));

                // Execute statement
                if(sqlsrv_execute($sql_stmt) === false)
                {
                    die(print_r(sqlsrv_errors(), true));
                }

                // Clean up resources
                sqlsrv_free_stmt($sql_stmt);
                sqlsrv_close($MSSQL_CONNECTION);
                break;

            case 'update':
                global $MSSQL_CONNECTION;

                if(!empty($actor_name))
                { 
                    $updates[] = '@ACTOR_NAME = '."'".strtoupper($actor_name)."'"; 
                } else {
                    $actor_name = 'null';
                    $updates[] = '@ACTOR_NAME = '.$actor_name;
                }
                if(!empty($actor_award_id))
                { 
                    $updates[] = '@ACTOR_AWARD_ID = '.$actor_award_id; 
                } else {
                    $actor_award_id = 'null';
                    $updates[] = '@ACTOR_AWARD_ID = '.$actor_award_id;
                }

                if(!empty($actor_id))
                {
                    $updates[] = '@ACTOR_ID = '.$header_actor_id;
                } else {
                    echo json_encode('Must include actor id in header');
                }

                $sql = "EXEC sp_update_actor ".implode(',',$updates);

                // Prepare sql
                $sql_stmt = sqlsrv_prepare($MSSQL_CONNECTION, $sql);

                // Execute sql
                if(sqlsrv_execute($sql_stmt) === false)
                {
                    die(print_r(sqlsrv_errors(), true));
                }

                // Clean up resources
                sqlsrv_free_stmt($sql_stmt);
                sqlsrv_close($MSSQL_CONNECTION);
                break;
        }
    }
    
    ?>