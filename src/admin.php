<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>SCU Bug Tracker</title>
    <?php
        include 'db.php';

        session_start();
        if (!$_SESSION['valid']) {
            header("Location: login.php");
        }
    ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <p class="navbar-brand">SCU Bug Tracker</p>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto"> </ul>
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container col-md-8 col-md-offset-2">
        <h1>Welcome, <?php echo $_SESSION['firstname']; ?>!</h1>
        <hr />
        <br />

        <p>Please use the form below to create a new employee account.</p>
        <form action="new_user.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputFirstName">First Name</label>
                    <input type="text" name="firstName" class="form-control"
                        id="inputFirstName" placeholder="First name" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputLastName">Last Name</label>
                    <input type="text" name="lastName" class="form-control"
                        id="inputLastName" placeholder="Last name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail">Email address (username)</label>
                <input type="email" class="form-control" name="email"
                    id="inputEmail" placeholder="Email address" required>
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" name="password"
                    id="inputPassword" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="inputEmployeeID">Employee ID</label>
                <input type="text" name="employeeid" class="form-control"
                    id="inputEmployeeID" placeholder="Employee ID" required>
            </div>
            <div class="form-group">
                <label for="inputType">Employee Type</label>
                <select type="text" class="form-control" name="etype"
                    id="inputType">
                    <option>Manager</option>
                    <option>Tester</option>
                    <option>Developer</option>
                    <option>Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <br />
        <hr />
        <br />
        <br />

        <h2>All Registered Employees</h2>
        <div>
            <?php
                $conn = db_connect();
                print_rows_query($conn, 'Employees', "SELECT EmployeeID, Email, LastName, FirstName
                                                        FROM Employees");
                db_close($conn);
            ?>
        </div>

        <br />
        <br />
        <br />
        <br />

        <h2>All Bug Tickets</h2>
        <div>
            <?php
                $conn = db_connect();
                print_rows_query($conn, 'Bugs', "SELECT * FROM Bugs");
                db_close($conn);
            ?>
        </div>
    </div>

    <!-- Bootstrap JS / jQuery CDN links -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>