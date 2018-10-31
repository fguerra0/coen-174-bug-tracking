<!DOCTYPE html>
<html>
<body>
    Welcome
    <?php

    include 'db.php';

    $lastname = $_POST['lastName'];
    $firstname = $_POST['firstName'];
    $email = $_POST['email'];
    $description = $_POST['description'];
    $id = rand(3, 255);

    $conn = db_connect();

    $query = "INSERT INTO Bugs (Bugid, LastName, FirstName, Email, Description)
              VALUES ($id, '$lastname', '$firstname', '$email', '$description')";
    print $query;

    insert_row($conn, $query);

    db_close($conn);

    ?>
    <br />
</body>
</html>

