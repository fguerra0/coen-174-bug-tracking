<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCU Bug Tracker</title>
    <?php
        include 'db.php';
    ?>
</head>
<body>
    <?php
        $conn = db_connect();
        print_rows($conn, 'Bugs');
        db_close($conn);
    ?>

    <h2>Welcome to the</h2>
    <h1>SCU Bug Tracker</h1>

    <hr />
    <p>Please use the form below to report a bug with SCU services.</p>

    <form action="welcome_get.php" method="post">
        Last Name: <input type="text" name="lastName" required>
        First Name: <input type="text" name="firstName" required>
        <br />
        Email: <input type="text" name="email" required>
        <br />
        Description: <input type="text" name="description" required>
        <br />
        <input type="submit" value="Submit">
    </form>
</body>
</html>