<?php
    require($_SERVER['DOCUMENT_ROOT'].'/movie_project/mssql_connection.php');
    global $MSSQL_CONNECTION;

    // GET
    (isset($_GET['mode'])) ? $mode = $_GET['mode'] : $mode = '';

    // POST

    // Initialize variables
    $username = "";
    $password = "";
    $loginError = "";

    // Check if the login form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        // Get the user input from the login form
        $username = $_POST['username'];
        $password = $_POST['password'];

        if(isset($username) & isset($password))
        {
                    // Prepare and execute the SQL query to retrieve user data
            $sql = "SELECT PASSWORD FROM USER_LOGIN WHERE USERNAME = ?";
            $params = array($username);
            $stmt = sqlsrv_query($MSSQL_CONNECTION, $sql, $params);

            if ($stmt !== false && sqlsrv_has_rows($stmt)) {
                // Fetch the row
                $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

                // Verify the password
                if (password_verify($password, $row['PASSWORD'])) {
                    // Password is correct, user is logged in
                    session_start();
                    $_SESSION['USERNAME'] = $username;
                    $response = 'success';
                    
                   header('Content-Type: application/json');
                   echo json_encode($response);
                   exit();
                }
            } else {
                $response = 'failed';
                header('Content-Type: application/json');
                echo json_encode($response);
                exit();
            }

            
        }
    }

    // Close the statement and the database connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
?>