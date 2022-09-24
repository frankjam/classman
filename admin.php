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
                            <li><a data-bs-toggle="modal" data-bs-target="#ManageclassRepsModal" href="">Class reps Manage </a> </li>
                            <li><a data-bs-toggle="modal" data-bs-target="#MessageclassRepsModal" href="">Send message to class-reps</a></li>
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
                            <li><a data-bs-toggle="modal" data-bs-target="#UnitsRegisterModal" href="">Register units</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <h4 class="card-title text-center">Upcoming tasks/events</h4>
                    <div class="card-body">
                        <ul>
                            <?php $adminTools->listTaskEvents(); ?>
                        </ul>
                        <button class="float-end btn-sm" data-bs-toggle="modal" data-bs-target="#NewTaskModal">Add new task</button>
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
<!-- NewTaskModal Modal -->
<div class="modal fade" id="NewTaskModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="NewTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="NewTaskModalLabel">Contact us form </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="emailFormControlInput" class="form-label">Email address</label>
                        <input type="email" required name="contactemail" class="form-control" id="emailFormControlInput" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="MobileFormControlInput" class="form-label">Mobile Number</label>
                        <input type="number" required name="contactphone" class="form-control" id="MobileFormControlInput" placeholder="254-7155-92073">
                    </div>
                    <div class="mb-3">
                        <label for="issueFormControlTextarea" class="form-label">Describe your issue </label>
                        <textarea class="form-control" required name="contactissue" id="issueFormControlTextarea" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="contactformsubmit" class="btn btn-primary">Submit</button>
                </div>
        </div>
        </form>
    </div>
</div>


<!-- ManageclassRepsModal Modal -->
<div class="modal fade" id="ManageclassRepsModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ManageclassRepsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="ManageclassRepsModalLabel">Contact us form </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="emailFormControlInput" class="form-label">Email address</label>
                        <input type="email" required name="contactemail" class="form-control" id="emailFormControlInput" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="MobileFormControlInput" class="form-label">Mobile Number</label>
                        <input type="number" required name="contactphone" class="form-control" id="MobileFormControlInput" placeholder="254-7155-92073">
                    </div>
                    <div class="mb-3">
                        <label for="issueFormControlTextarea" class="form-label">Describe your issue </label>
                        <textarea class="form-control" required name="contactissue" id="issueFormControlTextarea" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="contactformsubmit" class="btn btn-primary">Submit</button>
                </div>
        </div>
        </form>
    </div>
</div>
<?php require_once('footer.php'); ?>