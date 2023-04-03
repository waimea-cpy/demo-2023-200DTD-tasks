<?php
    require_once 'common-functions.php';
    require_once 'common-top.php';

?>

<h2>New Project</h2>

<form method="POST" action="process-new-project.php">

    <label>Project Name</label>
    <input name="name" type="text" required>

    <label>Notes / Description</label>
    <textarea name="description" required></textarea>

    <label>Due Date</label>
    <input name="due" type="date" min="<?= Date('Y-m-d') ?>" required>

    <input type="submit" value="Add Project">

</form>

<?php
    require_once 'common-bottom.php';
?>
