<?php
// Database connection details
$serverName = 'localhost';
$database = 'AWARD_WINNING_MOVIES';
$username = 'sa';
$password = 'CSC625databaseproject';

try {
    // Establish the database connection
    $conn = new PDO("sqlsrv:Server=$serverName;Database=$database", $username, $password);
    
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Prepare and execute the SQL query
    $sql = "SELECT * FROM MOVIE M
            INNER JOIN GENRE G ON M.MOVIE_ID = G.GENRE_ID 
            ORDER BY M.MOVIE_ID";

    $stmt = $conn->query($sql);
    
    // Fetch all rows as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Close the database connection
    $conn = null;
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
    die();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto; /* Center the table horizontally */
        }

        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e6e6e6;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Award Winning Movies</h1>
    </div>
    <table>
        <tr>
            <th>Title</th>
            <th>Description</th>
            <th>Genre</th>
            <th>Release Year</th>
            <th>Rating</th>
        </tr>
        <?php
        // Iterate over each row in the data and display it in the table
        foreach ($data as $row) {
            echo "<tr>";
            echo "<td>" . $row['Title'] . "</td>";
            echo "<td>" . $row['Description'] . "</td>";
            echo "<td>" . $row['Genre_Name'] . "</td>";
            echo "<td>" . $row['Release_Year'] . "</td>";
            echo "<td>" . $row['Rating'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
