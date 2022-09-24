<?php 
require_once('header.php'); 
if(empty($_SESSION['user_id'])){
    header('location: login.php');
}

if(!empty($_GET['action']) && ($_GET['action'] == 'logout')){
    session_destroy();
}
header('refresh:5');
?>

<div class="container">
    <table>
        <thead>
            <th> # </th>
            <th>Unit name</th>
            <th>Unit code</th>
            <th>Action </th>
        </thead>
        <tbody>
           <?php $units = new units;  $units->units_view(1,2); ?>
        </tbody>
    </table>
</div>


<?php require_once('footer.php'); ?>