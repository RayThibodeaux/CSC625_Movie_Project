<?php
    require($_SERVER['DOCUMENT_ROOT'].'/movie_project/mssql_connection.php');
    global $MSSQL_CONNECTION;

    // Initialize variables
    $username = "";
    $password = "";
    $loginError = "";

    // Check if the login form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get the user input from the login form
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Prepare and execute the SQL query to retrieve user data
        $sql = "SELECT PASSWORD FROM USER_LOGIN WHERE User = ?";
        $params = array($username);
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt !== false && sqlsrv_has_rows($stmt)) {
            // Fetch the row
            $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

            // Verify the password
            if (password_verify($password, $row['Password'])) {
                // Password is correct, user is logged in
                session_start();
                $_SESSION['Username'] = $username;
                header("Location: ../main.php"); // Redirect to the welcome page
                exit();
            }
        }

        echo $loginError = "Invalid username or password";
        header("refresh:5; url=/Login/home.html");
    }

    // Close the statement and the database connection
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
?>