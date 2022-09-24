<?php
require_once('header.php');
if (!empty($_SESSION['user_id'])) {
    header('location: index.php');
}
?>
<div class="container">
    <div class="row" style="margin-left: 30%;">
        <form method="POST" action="" class="">
            <div class="form-group">
                <label for="email">Enter your email </label><br>
                <input type="email" name="classrepemail" id="email" />
            </div>
            <div class="form-group">
                <label for="password">Enter your password </label><br>
                <input type="password" name="pass" id="password" />
            </div>
            <input type="submit" name="clogin" value="Login" />
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