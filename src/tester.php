<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

    <title>SCU Bug Tracker</title>
    <?php
        include 'db.php';

        if (isset($_POST['status'])) {
            $bug_id = $_POST['bugID'];
            $status = $_POST['status'];

            $conn = db_connect();

            update_status($conn, 'Bugs', $bug_id, $status);

            db_close($conn);
        }
    ?>
</head>
<body>
    <h1>Welcome, Tester!</h1>
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
    <form action="tester.php" method="post">
        <input type="text" name="bugID" placeholder="Bug ID">
        <br />
 	    <input type="text" name="status" placeholder="Status of current bug">
        <br />

        <input type="submit" value="Update">
    </form>
    </form>
</body>
</html>
