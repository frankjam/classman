<?php
require_once('header.php');
if (empty($_SESSION['user_id'])) {
    header('location: login.php');
}


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


<div class="container pt-5">
<div class="row">
            Extra resources
        </div>
    <div class="row">
        <div class="col">
            <?php echo $unit->revmaterials($unitid); ?>
        </div>
    </div>
</div>


<?php require_once('footer.php'); ?>