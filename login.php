<?php
require_once('header.php');
if (!empty($_SESSION['user_id'])) {
    header('location: index.php');
}
?>
<div class="container">
    <div class="row">
        <p class="lead text-center">Class representative login area</p>
    </div>
    <div class="row" style="margin-left: 20%;margin-right: 20%;">
        <form method="POST" action="" class="">
            <div class="form-group">
                <label for="email" class="form-label">Enter your email </label><br>
                <input type="email" class="form-control" name="classrepemail" id="email" />
            </div>
            <div class="form-group">
                <label for="password" class="form-label">Enter your password </label><br>
                <input type="password" class="form-control" name="pass" id="password" />
            </div>
            <div class="mt-3 float-end">
            <input type="submit" name="clogin" class ="btn btn-primary" value="Login" />
            </div>
        </form>
    </div>
</div>



<?php
$user = new user;

if (isset($_POST['clogin'])) {
    $email = $_POST['classrepemail'];
    $password = $_POST['pass'];

    $user->login($email, $password);
}
?>