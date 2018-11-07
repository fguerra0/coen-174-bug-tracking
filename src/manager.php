<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
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

            <form action="" method="post">
                <div class="form-group">
                    <label for="selectBug">Select a Bug</label>
                    <select class="form-control" id="selectBug" name="selectBug">
                        <option>1 - This Bug</option>
                        <option>2 - Weird Interaction</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="selectTester">Assign a Tester</label>
                    <select class="form-control" id="selectTester" name="selectTester">
                        <option>1 - Bob Tester</option>
                        <option>2 - Jane Tester</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="selectDeveloper">Assign a Developer</label>
                    <select class="form-control" id="selectDeveloper" name="selectDeveloper">
                        <option>1 - Wendy Developer</option>
                        <option>2 - Bill Developer</option>
                    </select>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
