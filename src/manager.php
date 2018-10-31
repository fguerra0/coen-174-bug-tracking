<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style.css">

    <title>SCU Bug Tracker</title>
    <?php
        include 'db.php';

        if (isset($_POST['developerID']) && isset($_POST['testerID'])){
            $bug_id = $_POST['bugID'];
            $developer_id = $_POST['developerID'];
			$tester_id = $_POST['testerID'];

            $conn = db_connect();

            assign_task($conn, 'Bugs', $bug_id, $developer_id, $tester_id);

            db_close($conn);
        }
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

    <form action="manager.php" method="post">
        Bug ID: <input type="text" name="bugID" required>
        Tester ID: <input type="text" name="testerID" required>
        Developer ID: <input type="text" name="developerID" required>
        <br />
        <input type="submit" value="Assign">
    </form>
    </div>
</body>
</html>
