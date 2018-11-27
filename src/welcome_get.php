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

    $lastname = $_POST['lastName'];
    $firstname = $_POST['firstName'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $description = $_POST['description'];
    $id = uniqid();
    $today = date('Y-m-d');


    $conn = db_connect();

    $query = "INSERT INTO Bugs (Bugid, LastName, FirstName, Email,
                                Subject, Description, Status, DateSubmitted)
              VALUES ('$id', '$lastname', '$firstname', '$email',
                      '$subject', '$description', 'submitted', TO_DATE('$today', 'yyyy-mm-dd'))";

    insert_row($conn, $query);

    db_close($conn);

    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.html">SCU Bug Tracker</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"> </ul>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="client.php">Client</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manager.php">Manager</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tester.php">Tester</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="developer.php">Developer</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container col-md-8 col-md-offset-2">
        <div class="jumbotron">
            <h1 class="display-4">Thank you!</h1>
            <p class="lead">We appreciate your bug report ~</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="client.php" role="button">Okay!</a>
            </p>
        </div>
    </div>

    <!-- Bootstrap JS / jQuery CDN links -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>

