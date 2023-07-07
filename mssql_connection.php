<?php

// #########################################################################
// VARIABLE
// #########################################################################
$server = "127.0.0.1";
$username = "sa";
$password = "CSC625databaseproject";
$dbName = "AWARD_WINNING_MOVIES";

$connectionOptions = [
    'Database' => $dbName,
    'UID' => $username,
    'PWD' => $password
];

function exception_handler($exception)
{
    // Log the exception details securely
    error_log('Uncaught exception: ' . $exception->getMessage());
    
    // Display a user-friendly error message
    echo '<h1>Failure</h1>';
    echo 'An error occurred while processing your request. Please try again later.';
}

function formatErrors($errors)
{
    // DISPLAY ERRORS
    echo '<h1>SQL ERROR:</h1>';
    echo 'Error information: <br />';

    foreach ($errors as $error) {
        echo 'SQLSTATE: ' . $error['SQLSTATE'] . '<br />';
        echo 'CODE: ' . $error['code'] . '<br />';
        echo 'MESSAGE: ' . $error['message'] . '<br />';
    }
}

set_exception_handler('exception_handler');

try {
    // ESTABLISH CONNECTION
    global $MSSQL_CONNECTION;
    $MSSQL_CONNECTION = sqlsrv_connect($server, $connectionOptions);
    if ($MSSQL_CONNECTION === false) {
        die(formatErrors(sqlsrv_errors()));
    }
} catch (Throwable $e) {
    // Log the exception details securely
    error_log('Connection failed: ' . $e->getMessage());
    
    // Display a user-friendly error message
    echo '<h1>Failure</h1>';
    echo 'An error occurred while processing your request. Please try again later.';
}

?>