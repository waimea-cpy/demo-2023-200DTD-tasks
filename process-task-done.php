<?php

    require_once 'common-functions.php';

    echo '<pre>';
    print_r( $_GET );
    echo '</pre>';

    // Get the task ID from the GET array
    $taskID = $_GET['id'];

    echo '<h2>Marking task as done...</h2>';

    // Modify the task record to mark it done
    $sql = 'UPDATE tasks
            SET done = 1
            WHERE id = ?';

    modifyRecords( $sql, 'i', $taskID );

    // Get the project ID for that task so we can return to project page
    $sql = 'SELECT project
            FROM tasks
            WHERE id = ?';

    $tasks = getRecords( $sql, 'i', $taskID );
    $task = $tasks[0];

    header( 'location: show-project.php?id='.$task['project'] );


?>