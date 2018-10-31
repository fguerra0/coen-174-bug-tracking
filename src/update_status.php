<!DOCTYPE html>
<html>
<body>
    <?php

    include 'db.php';

    $bug_id = $_POST['bugID'];
    $status = $_POST['status'];

    $conn = db_connect();

    update_status($conn, 'Bugs', $bug_id, $status);

    db_close($conn);

    ?>
    <br />
</body>
</html>
