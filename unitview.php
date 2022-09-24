<?php
require_once('header.php');
if (empty($_SESSION['user_id'])) {
    header('location: login.php');
}

header('refresh:5');

$unitid = base64_decode($_GET['viewunit']);

$unit = new units();
?>
<div class="container">
    <div class="row text-center">
        <h2>Unit resources </h2> 
    </div>
</div>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Unit name</th>
                <th>Unit code</th>
            </tr>
        </thead>
        <tbody>
            <?php $unit->detailed_unit_view($unitid); ?>
        </tbody>
    </table>
</div>





<?php require_once('footer.php'); ?>