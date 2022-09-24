<?php 
require_once('header.php'); 
if(empty($_SESSION['user_id'])){
    header('location: login.php');
}

if(!empty($_GET['action']) && ($_GET['action'] == 'logout')){
    session_destroy();
}
header('refresh:5');

$unitid = base64_decode($_GET['viewunit']);

$unit = new units();
?>

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



<?php require_once('footer.php'); ?>