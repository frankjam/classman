<?php 
require_once('header.php'); 
if(!empty($_SESSION['user_id'])){
    header('location: index.php');
}
?>

<form method="POST" action="">
    <input type="email" name="classrepemail" />
    <input type="password" name="pass" />
    <input type="submit" name="clogin" value="Login" />

</form>

<?php 
$user = new user;

if(isset($_POST['clogin'])){
    $email = $_POST['classrepemail'];
    $password = $_POST['pass'];

    $user->login($email,$password);

}
?>