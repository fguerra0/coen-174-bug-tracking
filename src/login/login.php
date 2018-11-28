<?php
	ob_start();
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>SCU Bug Tracker</title>
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
                    <a class="nav-link" href="../../index.php">Report A Bug</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container col-md-8 col-md-offset-2">
        <h1>Welcome to the SCU Bug Tracker!</h1>
	<br />
		<h3>Enter your Username and Password</h3>
		<div class = "container form-signin">

			<?php
            include '../db/backend.php';

            /*
             * This ...
             *
             */
            if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                $conn = db_connect();
                $username = $_POST['username'];
                $query = "SELECT * FROM employees WHERE email = :uname";
                $bindings = array(':uname' => $username);
                $hash = get_field($conn, $query, $bindings, 'PASSWORD');
                $valid = password_verify($_POST['password'], $hash);
                if ($valid) {
                    if (password_needs_rehash($hash, PASSWORD_DEFAULT)) {
                        $newHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        safe_sql_query($conn, "UPDATE employees SET password = :hashv WHERE email = :uname",
                                        array(':hashv' => $newHash, ':uname' => $username));
                    }
                    $_SESSION['valid'] = true;
                    $_SESSION['timeout'] = time();
                    $_SESSION['username'] = $username;
                    $_SESSION['firstname'] = get_field($conn, $query, $bindings, 'FIRSTNAME');
                    $_SESSION['employeeid'] = get_field($conn, $query, $bindings, 'EMPLOYEEID');
                    $base_uri = dirname($_SERVER['REQUEST_URI']);
                    $title = strtolower(get_field($conn, $query, $bindings, 'EMPLOYEETYPE'));
                    header("Location: http://students.engr.scu.edu" . $base_uri . "/../it-dept/" . $title . ".php");
                } else {
                    echo "Wrong Username and/or password";
                }
                db_close($conn);
            }
			?>
		</div>
		<div class="container">
            <form class="form-signin" role="form"
                action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <h4 class="form-signin-heading"></h4>
                <input type="text" class="form-control" name="username" placeholder="Email" required autofocus></br>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
                <br />
                <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
            </form>
	        <br />
        </div>
	</div>

    <!-- Bootstrap JS / jQuery CDN links -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
