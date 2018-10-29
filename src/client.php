<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCU Bug Tracker</title>
</head>
<body>
    <?php

    include 'db.php';

    $stid = oci_parse($conn, 'SELECT * FROM Bugs');
    oci_execute($stid);

    $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
    echo $row;

    ?>

    <h2>Welcome to the</h2>
    <h1>SCU Bug Tracker</h1>

    <hr />
    <p>Please use the form below to report a bug with SCU services.</p>

    <form action="welcome_get.php" method="get">
        LastName: <input type="text" name="name" required>
        FirstName: <input type="text" name="name" required>
        <br />
        Email: <input type="text" name="email" required>
        <br />
        Description: <input type="text" name="description" required>
        <br />
        <input type="submit" value="Submit">
    </form>
</body>
</html>
