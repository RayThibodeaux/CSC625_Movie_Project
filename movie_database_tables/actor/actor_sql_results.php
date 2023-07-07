<html>
    <style>
        html { background-color:  #461D7C; }

        h1 { font-family: 'Play'; font-size: 20px; color:orange; padding: 0px 10px 10px 10px;}
        h4 { font-family: 'Play'; color:mediumpurple; padding: 0px 0px 0px 10px;}
        table { font-family: 'Oxygen Mono'; font-size: 14px; color:gold;width: 100%; border-collapse: collapse; }
        table th{ border-bottom: 4px solid gold; text-align: center; padding: 10px 0px 2px 4px;}
        table td { text-align: center; vertical-align: middle; }
        table tr { page-break-inside:avoid; page-break-after:auto;}
        .topborder { border-top: 1px solid black; }
    </style>
    <head>
        <title>ALL ACTORS</title>
    </head>
    <body style="background-color: #461D7C;">
    <p style="color: gold; text-align: center">****************************** AWARD WINNING MOVIES SYSTEM ******************************</p>


    <?php
    // THIS PAGE ONLY FOR DISPLAYING SELECT STATEMENTS

    session_start();
    require($_SERVER['DOCUMENT_ROOT'].'/movie_project/mssql_connection.php');

    if(isset($_GET['header_actor_id'])){ $header_actor_id = $_GET['header_actor_id'];}

    ######################################################################################################################################################
    // SWITCH TO DETERMINE MODE
    print('<table>');
    print('<thead>');
    print('<th>ACTOR ID</th>');
    print('<th>ACTOR NAME</th>');
    print('<th>ACTOR AWARD ID</th>');
    print('</thead>');
    print('<tbody>');

    switch ($_GET['mode']) {
        
        case 'select':
            $sql = "SELECT ACTOR_ID, ACTOR_NAME, ACTOR_AWARD_ID FROM ACTOR";

            $sql_query = sqlsrv_query($MSSQL_CONNECTION, $sql);

            while($row = sqlsrv_fetch_array($sql_query, SQLSRV_FETCH_ASSOC))
            {
                print('<tr>');
                print('<td>' . $row['ACTOR_ID'] . '</td>');
                print('<td>' . $row['ACTOR_NAME'] . '</td>');
                print('<td>' . $row['ACTOR_AWARD_ID'] . '</td>');
                print('</tr>');
            }
        
            print('</tbody>');
            sqlsrv_free_stmt($sql_query);
            sqlsrv_close($MSSQL_CONNECTION);
            break;

        case 'single_select':

            $sql_results = array();
                global $MSSQL_CONNECTION;

                $sql = "SELECT ACTOR_ID, ACTOR_NAME, ACTOR_AWARD_ID
                    FROM ACTOR
                    WHERE ACTOR_ID = ".$header_actor_id;

                $sql_query = sqlsrv_query($MSSQL_CONNECTION, $sql);
                
                while($row = sqlsrv_fetch_array($sql_query, SQLSRV_FETCH_ASSOC))
                {
                    print('<tr>');
                    print('<td>' . $row['ACTOR_ID'] . '</td>');
                    print('<td>' . $row['ACTOR_NAME'] . '</td>');
                    print('<td>' . $row['ACTOR_AWARD_ID'] . '</td>');
                    print('</tr>');
                }

                sqlsrv_free_stmt($sql_query);
                sqlsrv_close($MSSQL_CONNECTION);
                break;

    }

    ?>
    <img src="<?php echo 'data:image/png;base64,' . base64_encode(file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/movie_project/img/lsus-logo.png')); ?>"
        class="logo-img" height="150">
    </body>
    </html>
