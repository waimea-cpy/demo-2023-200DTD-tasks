<?php
    require_once 'common-functions.php';
    require_once 'common-top.php';

?>


<nav id="add-button">
    <a href="form-new-project.php">+</a>
</nav>


<?php

    // Let's get all of our projects
    $sql = 'SELECT id, name, description, due
            FROM projects
            ORDER BY due ASC';

    $projects = getRecords( $sql );

    echo '<p>It is <strong>'.date( 'j M Y' ).'</strong>';
    echo '<p>What are you going to work on today?</p>';

    echo '<section id="project-list">';

    // Loop thru them all
    foreach( $projects as $project ) {

        // Get a count of the tasks for this project
        $sql = 'SELECT COUNT(id) AS taskCount
                FROM tasks
                WHERE project = ?';

        $records = getRecords( $sql, 'i', $project['id'] );
        $totalTasks = $records[0]['taskCount'];

        // Get a count of the DONE tasks for the project
        $sql = 'SELECT COUNT(id) AS taskCount
                FROM tasks
                WHERE done = 1 AND project = ?';

        $records = getRecords( $sql, 'i', $project['id'] );
        $doneTasks = $records[0]['taskCount'];

        // Should the project be shown as DONE?
        if( $totalTasks > 0 && $totalTasks == $doneTasks ) {
            $class="project done";
        }
        else {
            $class="project";
        }

        // Show the project
        echo '<a class="'.$class.'"
                 href="show-project.php?id='.$project['id'].'">';

        echo   '<header>';
        echo     '<h3>'.$project['name'].'</h3>';
        echo   '</header>';

        // Is the project LATE?
        if( isInPast( $project['due'] ) == true ) {
            echo '<p class="late">';
        }
        else {
            echo '<p>';
        }
        echo     'Due on: <strong>'.niceDate( $project['due'] ).'</strong>';
        echo     ' ('.daysFromToday( $project['due'] ).')';
        echo   '</p>';

        // Show the task completion counts
        echo   '<p>'.$doneTasks.'/'.$totalTasks.' tasks completed</p>';

        echo '</a>';
    }

    echo '</section>';

    require_once 'common-bottom.php';
?>