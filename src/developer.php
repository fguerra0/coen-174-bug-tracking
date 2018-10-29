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
    <h1>Welcome, Developer!</h1>
    <hr />
    <div>
        <p>
            <?php
                $conn = db_connect();
                print_rows($conn, 'Bugs');
                db_close($conn);
            ?>
        </p>
    </div>
    <form action="">
        <input type="text" name="status" placeholder="Status of current bug">
        <br />
        <input type="text" name="details" placeholder="Any additional details or comments?">
        <br />

        <input type="submit" value="Update">
    </form>
</body>
</html>
