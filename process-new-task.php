<?php

    require_once 'common-functions.php';

    echo '<pre>';
    print_r( $_POST );
    echo '</pre>';

    // Get the form data from the POST array
    $taskName  = $_POST['name'];
    $projectID = $_POST['project'];

    echo '<h2>Adding task...</h2>';

    $sql = 'INSERT INTO tasks (name, project) VALUES (?, ?)';

    modifyRecords( $sql, 'si', [$taskName, $projectID] );

    header( 'location: show-project.php?id='.$projectID );
?>