    <?php
    require($_SERVER['DOCUMENT_ROOT'].'/movie_project/mssql_connection.php');
    global $MSSQL_CONNECTION;

    // Get user input from the registration form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert user data into the database
    $sql = "INSERT INTO USER_LOGIN (USERNAME, PASSWORD) VALUES (?, ?)";
    $params = array($username, $hashedPassword);
    $stmt = sqlsrv_query($MSSQL_CONNECTION, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    } else {
        echo "Registration successful!";
    }

    // Close the database connection
    sqlsrv_close($MSSQL_CONNECTION);

    // Redirect to login page after 10 seconds
    header("refresh:5; url=/movie_project/index.php");
    exit();
    ?>