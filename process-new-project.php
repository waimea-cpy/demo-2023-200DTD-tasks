<?php

    require_once 'common-functions.php';

    echo '<pre>';
    print_r( $_POST );
    echo '</pre>';

    // Get the form data from the POST array
    $projectName = $_POST['name'];
    $projectDesc = $_POST['description'];
    $projectDue  = $_POST['due'];

    echo '<h2>Adding project...</h2>';

    $sql = 'INSERT INTO projects (name, description, due) VALUES (?, ?, ?)';

    modifyRecords( $sql, 'sss', [$projectName, $projectDesc, $projectDue] );

    header( 'location: index.php' );
?>