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
    <h1>Welcome, Manager!</h1>
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
    <div>
        <p>
            <?php
                $conn = db_connect();
                print_rows($conn, 'Testers');
                db_close($conn);
            ?>
        </p>
    </div>
    <div>
        <p>
            <?php
                $conn = db_connect();
                print_rows($conn, 'Devs');
                db_close($conn);
            ?>
        </p>
    </div>
    <div>
    <p>Use the form below to assign a bug to a developer:</p>

    <form action="assign_developer.php" method="post">
        Developer ID: <input type="text" name="developerID" required>
        Bug ID: <input type="text" name="bugID" required>
        <br />
        <input type="submit" value="Assign">
    </form>
    </div>
</body>
</html>
