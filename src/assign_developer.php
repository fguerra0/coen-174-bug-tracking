<!DOCTYPE html>
<html>
<body>
    <?php

    include 'db.php';

    $bug_id = $_POST['bugID'];
    $developer_id = $_POST['developerID'];

    $conn = db_connect();

    assign_task_developer($conn, 'Bugs', $bug_id, $developer_id);

    db_close($conn);

    ?>
</body>
</html>
