<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
 body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f2e9ff; 
        color: #605c00;
        font-family: Arial, sans-serif;
    }

    .container {
        width: 35%;
        padding: 20px;
        background-color: #fff; 
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    h2 {
        text-align: center;
        color: #663399; 
        margin: 0;
        padding: 10px;
        border-radius: 5px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    input[type="submit"],
    .register-button {
        background-color: #f0d300; 
        color: #663399; 
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover,
    .register-button:hover {
        background-color: #d2b300; 
    }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='http://fonts.googleapis.com/css?family=Play:400,700' rel='stylesheet' type='text/css'>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form id="login_form">
            <label for="username">Username:</label>
            <input type="text" id="input_username" name="input_username"><br><br>

            <label for="password">Password:</label>
            <input type="password" id="input_password" name="input_password"><br><br>

            <input type="submit" id="login" value="Login">
            <input type="submit" id="register" value="Register">
        </form>
    </div>
</body>
<script><?php require($_SERVER['DOCUMENT_ROOT'] . '/movie_project/js/login_register_ajax.js'); ?></script>
</html>