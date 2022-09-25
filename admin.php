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
                            <li><a data-bs-toggle="modal" data-bs-target="#SendMessageModal" href="">Send message to class-reps</a></li>
                        </ul>
                    </div>
                </div>

            </div>
            <div class="col">
                <div class="card">
                    <h4 class="card-title text-center">Manage myself</h4>
                    <div class="card-body">
                        <ul>
                            <li> <a data-bs-toggle="modal" data-bs-target="#UploadNotesModal" href="">Upload notes</a></li>
                            <li><a data-bs-toggle="modal" data-bs-target="#RegisterUnitModal" href="">Register units</a></li>
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
<!-- RegisterUnitModal -->
<div class="modal fade" id="RegisterUnitModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="RegisterUnitModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="RegisterUnitModalLabel">Register units form </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="unitcodeFormControlInput" class="form-label">Enter unit code</label>
                        <input type="text" required name="unitcode" class="form-control" id="unitcodeFormControlInput" placeholder="ITCR 316">
                    </div>
                    <div class="mb-3">
                        <label for="unitnameFormControlInput" class="form-label">Enter unit name</label>
                        <input type="text" required name="unitname" class="form-control" id="unitnameFormControlInput" placeholder="Mobile application II">
                    </div>
                    <div class="mb-3">
                        <label for="YearFormControlInput" class="form-label">Enter year</label>
                        <input type="number" required name="dates" class="form-control" id="YearFormControlInput" placeholder="29 september 2022">
                    </div>
                    <div class="mb-3">
                        <label for="trimesterrepresenting" class="form-label">Pick trimester representing </label>
                        <br>
                        <select name="trimest" id="trimesterrepresenting">
                            <option value="" disabled>Select trimester representing</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Pick class rep</label> </br>
                        <select name="classrep" id="">
                            <?php $adminTools->classrepslist(); ?>

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="unitregform" class="btn btn-primary">Submit</button>
                </div>
        </div>
        </form>
    </div>
</div>

<!-- NewTaskModal Modal -->
<div class="modal fade" id="NewTaskModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="NewTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="NewTaskModalLabel">Add new event form </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="eventNameFormControlInput" class="form-label">Enter event name</label>
                        <input type="text" required name="eventname" class="form-control" id="eventNameFormControlInput" placeholder="Marketing Nkubu">
                    </div>
                    <div class="mb-3">
                        <label for="DateFormControlInput" class="form-label">Enter date</label>
                        <input type="date" required name="dates" class="form-control" id="DateFormControlInput" placeholder="29 september 2022">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="eventformsubmit" class="btn btn-primary">Submit</button>
                </div>
        </div>
        </form>
    </div>
</div>

<!-- SendMessageModal Modal -->
<div class="modal fade" id="SendMessageModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="SendMessageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="SendMessageModalLabel">Message class reps form </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label>Pick class rep</label> </br>
                        <select name="classreps" id="">
                            <?php $adminTools->classrepslist(); ?>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Enter Message</label>
                        <textarea name="messagerep" class="form-control"> </textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="sendMessageForm" class="btn btn-primary">Submit</button>
                </div>
        </div>
        </form>
    </div>
</div>

<!-- ManageclassRepsModal -->
<div class="modal fade" id="ManageclassRepsModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="ManageclassRepsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="ManageclassRepsModalLabel">Class rep. add form </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nameFormControlInput" class="form-label">Enter class rep name</label>
                        <input type="text" required name="classrepname" class="form-control" id="nameFormControlInput" placeholder="First last name">
                    </div>
                    <div class="mb-3">
                        <label for="emailFormControlInput" class="form-label">Email address</label>
                        <input type="email" required name="classrepemail" class="form-control" id="emailFormControlInput" placeholder="name@example.com">
                    </div>
                    <div class="mb-3">
                        <label for="PasswordFormControlInput" class="form-label">Password </label>
                        <input type="password" required name="classreppass" class="form-control" id="PasswordFormControlInput">
                    </div>
                    <div class="mb-3">
                        <label for="yearrepresenting" class="form-label">Enter year representing </label>
                        <input type="number" class="form-control" required name="yearrep" id="yearrepresenting" />
                    </div>
                    <div class="mb-3">
                        <label for="trimesterrepresenting" class="form-label">Pick trimester representing </label>
                        <br>
                        <select name="trime" id="trimesterrepresenting">
                            <option value="" disabled>Select trimester representing</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="classrepadd" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- UploadNotesModal Modal -->
<div class="modal fade" id="UploadNotesModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="UploadNotesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="UploadNotesModalLabel">Upload Notes form </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                <div class="mb-3">
                        <label  class="form-label">Pick Unit name</label> </br>
                        <select name="unitname" id="">
                        <?php $adminTools->unitsNameList(2022,3); ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Pick class rep</label> </br>
                        <select name="classreps" id="">
                            <?php $adminTools->classrepslist(); ?>

                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="outline"  class="form-label">Outline</label>
                        <input type="file" name="pic" id="outline" class="form-control"/>
                    </div>
                    <div class="mb-3">
                        <label for="chapter1"  class="form-label">Chapter 1</label>
                        <input type="file" name="pic" id="chapter1" class="form-control"/>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="UploadNotesForm" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if (isset($_POST['classrepadd'])) {
    $name = $_POST['classrepname'];
    $email = $_POST['classrepemail'];
    $pass = $_POST['classreppass'];
    $year = $_POST['yearrep'];
    $trimester = $_POST['trime'];
    $adminTools->addClassRep($name, $email, $pass, $year, $trimester);
}
if (isset($_POST['eventformsubmit'])) {
    $name = $_POST['eventname'];
    $date = $_POST['dates'];
    $adminTools->addTaskEvent($name, $date);
}
if (isset($_POST['unitregform'])) {
    $unitcode = $_POST['unitcode'];
    $unitname = $_POST['unitname'];
    $year = $_POST['dates'];
    $trimester = $_POST['trimest'];
    $classrep = $_POST['classrep'];

    $adminTools->addUnits($unitcode, $unitname, $year, $trimester, $classrep);
}
if (isset($_POST['sendMessageForm'])) {
    $classrep = $_POST['classreps'];
    $messagerep = $_POST['messagerep'];

    $adminTools->sendMessage($classrep, $messagerep);
}
if (isset($_POST['UploadNotesForm'])) {
    $classrep = $_POST['classreps'];
    $messagerep = $_POST['messagerep'];

    $adminTools->UploadNotes($classrep, $messagerep);
}
require_once('footer.php'); ?>