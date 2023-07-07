<style>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/movie_project/css/stylesheet.css'); ?>
</style>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    
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

<body style="background-color:  #461D7C" ;>
<form id="login_page">

    <div class="col-sm-4 login_box">
    <!-- <div class="col-sm-4 m-4 d-grid rcorner-sm lt-purple"> -->
        <h2>Login</h2>
            <label for="username" style="font-weight: bold">Username:</label>
            <input class="login-text" id="input_username" type="text" name="username" required><br><br>

            <label for="password" style="font-weight: bold">Password:</label>
            <input class="login-text" id="input_password" type="password" name="password" required><br><br>

            <button class="button btn-warning btn-primary-spacing height" type="submit" id="login_button">
                <span style="font-size: 15px; font-weight: bold">LOGIN</span>
            </button>

            <button class="button btn-warning btn-primary-spacing height" type="submit" id="register_button">
                <span style="font-size: 15px; font-weight: bold">REGISTER</span>
            </button>
        <!-- <input type="submit" value="Register" onclick="window.location.href='/Register/register_form.html';"> -->
    <!-- </div> -->
</div>
</form>
</body>
<script><?php require($_SERVER['DOCUMENT_ROOT'] . '/movie_project/js/actor_ajax.js'); ?></script>
</html>
