<!DOCTYPE html>
<html>
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

