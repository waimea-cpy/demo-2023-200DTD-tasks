<?php

    require_once 'common-functions.php';
    require_once 'common-top.php';


    // Get the project ID from the URL
    $projectID = $_GET['id'];

    //-------------------------------------------
    // Get the project details from the server
    $sql = 'SELECT name, description, due
            FROM projects
            WHERE id = ?';

    $projects = getRecords( $sql, 'i', $projectID );
    // Should only have one project
    $project = $projects[0];

    echo '<h2>'.$project['name'].'</h2>';

    echo '<p>'.$project['description'].'</p>';

    echo '<p>Due on: ';
    echo   '<strong>'.niceDate( $project['due'] ).'</strong> ('.daysFromToday( $project['due'] ).')';
    echo '</p>';

    //-------------------------------------------
    // Get all of the tasks for this project
    echo '<h3>Tasks</h3>';

    $sql = 'SELECT name, done
            FROM tasks
            WHERE project = ?';

    $tasks = getRecords( $sql, 'i', $projectID );

    echo '<ol id="task-list">';

    foreach( $tasks as $task ) {
        if( $task['done'] == true ) {
            echo '<li class="done">';
        }
        else {
            echo '<li>';
        }

        echo $task['name'];

        if( $task['done'] == false ) {
            echo ' <a href="process-task-done.php">Done</a>';
        }

        echo '</li>';
    }

    echo '</ol>';

?>

<form method="POST" action="process-new-task.php">

    <label>New Task</label>
    <input name="name" type="text" required>

    <input name="project" type="hidden" value="<?= $projectID ?>">

    <input type="submit" value="Add Task">

</form>

<?php
    require_once 'common-bottom.php';
?>