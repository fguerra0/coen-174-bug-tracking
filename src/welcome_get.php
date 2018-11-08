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

    <div class="container col-md-8 col-md-offset-2">
        <div class="jumbotron">
            <h1 class="display-4">Thank you!</h1>
            <p class="lead">We appreciate your bug report ~</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="client.php" role="button">Okay!</a>
            </p>
        </div>
    </div>
</body>
</html>

