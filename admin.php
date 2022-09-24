<?php
require("header.php");


$adminTools = new admintools();

if (empty($_SESSION['admin_user_name'])) { ?>
    <div class="container">
        <div class="row">
            <span class="lead text-center">Admin panel </span>
            
            <form method="POST" action="" class="">
                <div class="form-group">
                    <label for="user">Enter Username </label><br>
                    <input type="text" name="adminuser" id="user" />
                </div>
                <div class="form-group">
                    <label for="password">Enter your password </label><br>
                    <input type="password" name="pass" id="password" />
                </div>
                <input type="submit" name="alogin" value="Login" class="btn-primary" />
            </form>
        </div>
    </div>
    <?php
    if (isset($_POST['alogin'])) {
        $user = $_POST['adminuser'];
        $password = $_POST['pass'];

        $adminTools->adminlogin($user, $password);
    }
} else { ?>
    <div class="container">
        <div class="row ">
            <div class="col">
                
                <div class="card">
                    <h4 class="card-title text-center">Manage class reps </h4>
                    <div class="card-body">
                        <ul>
                            <li>Class reps Manage </li>
                            <li>Send message to class-reps</li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col">
                <div class="card">
                    <h4 class="card-title text-center">Manage myself</h4>
                    <div class="card-body">
                        <ul>
                            <li>Upload notes</li>
                            <li>Register units</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <h4 class="card-title text-center">Upcoming tasks/events</h4>
                    <div class="card-body">
                        <ul>
                            <li>29 september marketing </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <hr>
        <p class="lead text-center">My units logs </p>
        <form method="POST">
            <div class="row pb-4">
                <div class="col">
                    <select name="year" required>
                        <option value="" disabled selected>Pick year</option>
                        <option value="2022"> 2022 </option>
                    </select>
                    <select name="trim" required>
                        <option value="" disabled selected>Pick trimester</option>
                        <option value="1"> 1 </option>
                        <option value="2"> 2 </option>
                        <option value="3"> 3 </option>
                    </select>
                    <button type="submit" name="logview" class="btn btn-primary btn-sm">View </button>
                </div>
            </div>
        </form>

        <div class="row">
            <table class="table">
                <thead>
                    <th>Unit name</th>
                    <th>Unit code</th>
                    <th>Number of students</th>
                    <th>Cats done</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    <?php
                    if (isset($_POST['logview'])) {
                        $year = $_POST['year'];
                        $trimes = $_POST['trim'];
                        $adminTools->unitslog($year, $trimes);
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
<?php }

?>

<?php require_once('footer.php'); ?>