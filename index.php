<?php
    require_once 'common-functions.php';
    require_once 'common-top.php';

?>


<nav id="add-button">
    <a href="form-new-project.php">+</a>
</nav>


<?php

    $sql = 'SELECT id, name, description, due
            FROM projects
            ORDER BY due ASC';

    $projects = getRecords( $sql );

    echo '<p>It is <strong>'.date( 'j M Y' ).'</strong>';
    echo '<p>What are you going to work on today?</p>';

    echo '<section id="project-list">';

    foreach( $projects as $project ) {
        echo '<a class="project"
                 href="show-project.php?id='.$project['id'].'">';

        echo   '<header>';
        echo     '<h3>'.$project['name'].'</h3>';
        echo   '</header>';

        if( isInPast( $project['due'] ) == true ) {
            echo '<p class="late">';
        }
        else {
            echo '<p>';
        }
        echo     'Due on: <strong>'.niceDate( $project['due'] ).'</strong>';
        echo     ' ('.daysFromToday( $project['due'] ).')';
        echo   '</p>';
        echo '</a>';
    }

    echo '</section>';

    require_once 'common-bottom.php';
?>