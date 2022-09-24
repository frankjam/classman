<?php 
require_once('header.php'); 
if(empty($_SESSION['user_id'])){
    header('location: login.php');
}

if(!empty($_GET['action']) && ($_GET['action'] == 'logout')){
    session_destroy();
}
?>

<div class="container">
    <div class="row pb-3" >
        <span class="lead text-center pb-3"><u> Class representatives access point </u> </span>
       <p> <b> Lecturer: </b>  Frankline Gitonga</p> 
       <p> <b> Units for: </b> Year <?php echo $_SESSION['year'].' Trimester: '.$_SESSION['trimester']; ?> </p>
    </div>
    <table class="table">
        <thead>
            <th> # </th>
            <th>Unit name</th>
            <th>Unit code</th>
            <th>Class Rep</th>
            <th>Action </th>
        </thead>
        <tbody>
           <?php 
           $units = new units;  
           $units->units_view($_SESSION['year'],$_SESSION['trimester']); ?>
        </tbody>
    </table>
</div>


<?php require_once('footer.php'); ?>