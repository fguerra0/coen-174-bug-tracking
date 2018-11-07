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
    ?>
</head>
<body>
    <div class="container">
        <div class="col-md-8 col-md-offset-2">
            <h2>Welcome to the</h2>
            <h1>SCU Bug Tracker</h1>

            <hr />
            <p>Please use the form below to report a bug with SCU services.</p>

            <form action="welcome_get.php" method="post">
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
                    <label for="inputEmail">Email address</label>
                    <input type="email" class="form-control" name="email"
                        aria-describedby="emailHelp" id="inputEmail" placeholder="Email address" required>
                    <small id="emailHelp" class="form-text text-muted">
                        We'll never share your email with anyone else.
                    </small>
                </div>
                <div class="form-group">
                    <label for="inputDescription">Description</label>
                    <input type="text" class="form-control input-lg" name="description"
                        id="inputDescription" placeholder="Describe what happened..." required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>