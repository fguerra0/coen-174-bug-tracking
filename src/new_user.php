<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>SCU Bug Tracker</title>
</head>
<body>
    <?php

    include 'db.php';

    session_start();
    if ($_SESSION['valid']) {
        $lastname = $_POST['lastName'];
        $firstname = $_POST['firstName'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $employeeid = $_POST['employeeid'];
        $etype = $_POST['etype'];

        $conn = db_connect();
        $sql = "INSERT INTO employees (employeeid, email, lastname, firstname, password, employeetype)
                VALUES (:id, :email, :lastv, :firstv, :pass, :etype)";
        $bindings = array(':id' => $employeeid, ':email' => $email, ':lastv' => $lastname, ':firstv' => $firstname,
                        ':pass' => $hash, ':etype' => $etype);
        safe_sql_query($conn, $sql, $bindings);
        db_close($conn);
    } else {
        header("Location: login.php");
    }

    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <p class="navbar-brand">SCU Bug Tracker</p>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"> </ul>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container col-md-8 col-md-offset-2">
        <div class="jumbotron">
            <h1 class="display-4">Thank you!</h1>
            <p class="lead">Thank you for creating a new user! Their employee ID is: <?php print $employeeid; ?></p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="admin.php" role="button">Okay!</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS / jQuery CDN links -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

