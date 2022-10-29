<?php 
class databaseConnection{
  protected $user;
  protected $pass;
  protected $host;
  protected $dbname;
  public function __construct()
  {
   // $this->conn = new mysqli("sql206.epizy.com","epiz_32670958","Hcavp6yRMuZgWAt","epiz_32670958_classman");
    $this->conn = new mysqli("localhost","root","","classman");
  }

}

class user extends databaseConnection{
    public function login($email,$password){

        $sql="SELECT * FROM `classrepdetails` WHERE `email` ='$email' AND `password` ='$password'";
        $result= $this->conn->query($sql);

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['year'] = $row['during_year'];
            $_SESSION['trimester'] = $row['during_trimester'];

            header('location: index.php');
        }else{
            echo "incorrect password or email";
        }
    }
}

class units extends databaseConnection{
    public function revmaterials($id){
        $sql_cat_marks_view ="SELECT * FROM `revisionmaterials` WHERE revid = $id";
        $result = $this->conn->query($sql_cat_marks_view);
      
        if ($result->num_rows > 0) {
            $i = 1;
            while($row = $result->fetch_assoc()) {
                echo "<tr> 
                <td>".$i."</td>
                <td>".$row["unit_code"]."</td> 
                <td><a download href='".$row["location"]."' class='btn btn-primary btn-sm' >Download  </a></td> 
                </tr>";
                $i++;
            } 
    }}
    public function classrepname($id){
    

        $sql_classrepname ="SELECT name FROM `classrepdetails` WHERE id =$id";
        $result = $this->conn->query($sql_classrepname);
        $row = $result->fetch_assoc();
        return $row['name'];
    }

    public function units_view($ycws,$trimester){
      

        $sql_cat_marks_view ="SELECT * FROM `unitdetails` WHERE year = $ycws AND trimester = $trimester";
        $result = $this->conn->query($sql_cat_marks_view);
      
        if ($result->num_rows > 0) {
            $i = 1;
            while($row = $result->fetch_assoc()) {
                echo "<tr> 
                <td>".$i."</td>
                <td>".$row["unit_name"]."</td> 
                <td>".$row["unit_code"]."</td> 
                <td>".$this->classrepname($row["class_rep"])."</td> 
                <td>";
                if($_SESSION['user_id'] == $row["class_rep"]){
                    echo "<a href='unitview.php?viewunit=".base64_encode($row["id"])."' class='btn btn-primary btn-sm' >View details </a>";
                }
                echo"
                </td>
                </tr>";
                $i++;
            }  
        } else{
            echo "<tr> <td colspan='4' class='text-center py-4 text-info'> Check later  </td> </tr>";
        }
    }
    public function detailed_unit_view($unitid){
      

        $sql_cat_marks_view ="SELECT * FROM `unit_files_location` LEFT OUTER JOIN unitdetails on unitdetails.id = unit_files_location.id WHERE unitdetails.id =$unitid";
        $result = $this->conn->query($sql_cat_marks_view);
      
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr> 
                    <td>".$row["unit_name"]."</td> 
                    <td>".$row["unit_code"]."</td>
                </tr>
                <tr> <td> Outline : <a href='".$row["outline"]."' download class='btn btn-dark' >Download </a></td> </tr>
                ";

                for($i = 1; $i<=$row["no_of_chapters"]; $i++){
                    if($row["chapter_$i"] == NULL){
                        break;
                    }
                    echo "<tr> 
                    <td> Chaper $i: <a href='".$row["chapter_$i"]."' download class='btn btn-dark'> Download </a></td>
                    </tr>";
                }
            }
        } else{
            echo "<tr> <td colspan='4' class='text-center py-4 text-info'> Check later  </td> </tr>";
        }
    }
}
?>

<?php
class admintools extends databaseConnection{

        public function adminlogin($username, $password)
        {
          
    
            $sql = "SELECT * FROM `admin` WHERE `username` ='$username' AND `password` ='$password'";
            $result = $this->conn->query($sql);
    
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
    
                $_SESSION['user_id'] = $row['admin_id'];
                $_SESSION['admin_user_name'] = $row['username'];
    
                header('location: admin.php');
            } else {
                echo "incorrect password or email";
            }
        }
        public function UploadrevNotes($matname, $revnotes,$unitname){
            $sqlinsert="INSERT INTO `revisionmaterials` (`revid`, `matname`, `location`) 
            VALUES ('$unitname', '$matname', '$revnotes')";

            $result = $this->conn->query($sqlinsert);
            if($result){
                echo "<script> alert('Upload was a success'); </script>";
            }
        }
        public function classrepname($id){
    

            $sql_classrepname ="SELECT name FROM `classrepdetails` WHERE id =$id";
            $result = $this->conn->query($sql_classrepname);
            $row = $result->fetch_assoc();
            return $row['name'];
        }

        public function units_view($ycws,$trimester){
      

            $sql_cat_marks_view ="SELECT * FROM `unitdetails` WHERE year = $ycws AND trimester = $trimester";
            $result = $this->conn->query($sql_cat_marks_view);
          
            if ($result->num_rows > 0) {
                $i = 1;
                while($row = $result->fetch_assoc()) {
                    echo "<tr> 
                    <td>".$i."</td>
                    <td>".$row["unit_name"]."</td> 
                    <td>".$row["unit_code"]."</td> 
                    <td>".$this->classrepname($row["class_rep"])."</td> 
                    <td><a href='unitview.php?viewunit=".base64_encode($row["id"])."' class='btn btn-primary btn-sm' >View details </a>
                    </td>
                    </tr>";
                    $i++;
                }  
            } else{
                echo "<tr> <td colspan='4' class='text-center py-4 text-info'> Check later  </td> </tr>";
            }
        }

    public function unitslog($year,$trimester){ 
      

        $sql_cat_marks_view ="SELECT units_log.catsdone,units_log.numberofstudents, unitdetails.* FROM unitdetails LEFT OUTER JOIN `units_log` on unitdetails.id = units_log.id WHERE unitdetails.year= $year AND unitdetails.trimester = $trimester";
       
        $result = $this->conn->query($sql_cat_marks_view);
      
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr> 
                    <td>".$row["unit_name"]."</td> 
                    <td>".$row["unit_code"]."</td>
                    <td>".$row["numberofstudents"]."</td>
                    <td>";
                    if($row['catsdone'] == null){ echo 0; }else{ echo $row['catsdone']; }
                    echo "</td>
                    <td><a href=admin.php?modifylog='".$row["id"]."'>Modify</a>
                </tr>";
            }
        } else{
            echo "<tr> <td colspan='4' class='text-center py-4 text-info'> !! Not found Check later !! </td> </tr>";
        }
    }
    public function unitsNameList($year,$trimester){ 
      

        $sql_cat_marks_view ="SELECT id,unit_name FROM `unitdetails` WHERE year= $year AND trimester = $trimester";
       //echo $sql_cat_marks_view;
        $result = $this->conn->query($sql_cat_marks_view);
      
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option  value='".$row['id']."'> ".$row['unit_name']."</option>";
            }
        }
    }
    public function listTaskEvents(){
      

        $sql_cat_marks_view ="SELECT * FROM `taskevents` where expired != 1 limit 5";
       
        $result = $this->conn->query($sql_cat_marks_view);
      
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<li>".date('Y-M-d',strtotime($row['date']))." ->".ucfirst($row['name'])." </li>";
            }
        } else{
            echo "No Event found Check later";
        }
    }
    public function notesLinks(){
      

        $sql_cat_marks_view ="SELECT * FROM `unit_files_location` where id = 14";
       
        $result = $this->conn->query($sql_cat_marks_view);
      
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
                for($i = 1; $i <= $row['no_of_chapters']; $i++ ){
                    echo '
                    <div class="mb-3">
                    <label for="chapter'.$i.'" class="form-label">Chapter '.$i.'</label>
                    <input type="text" name="chapter'.$i.'" id="chapter'.$i.'" class="form-control" />
                    </div>
                    ';
                }
        }
    }
    public function classrepslist(){
      

        $sql_cat_marks_view ="SELECT id,name FROM `classrepdetails` ORDER BY `classrepdetails`.`during_year`";
       
        $result = $this->conn->query($sql_cat_marks_view);
      
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<option  value='".$row['id']."'> ".$row['name']."</option>";
            }
        } else{
            echo "Add class rep first";
        }
    }

    public function addClassRep($name,$email,$pass,$year,$trimester){
      

        $sql_cat_marks_view ="INSERT INTO `classrepdetails` (`id`, `name`, `email`, `password`, `during_year`, `during_trimester`) 
        VALUES (NULL, '$name', '$email', '$pass', '$year', '$trimester')";
       
        $result = $this->conn->query($sql_cat_marks_view);
    }

    public function addTaskEvent($name,$date){
      

        $sql_cat_marks_view =" INSERT INTO `taskevents` (`id`, `name`, `expired`, `date`)
         VALUES (NULL, '$name', '0', '$date')";
       
        $result = $this->conn->query($sql_cat_marks_view);
    }
    public function addUnits($unitcode,$unitname,$year,$trimester,$classrep,$NOC){
      

        $sql_cat_marks_view ="INSERT INTO `unitdetails` (`id`, `unit_code`, `unit_name`, `year`, `trimester`, `class_rep`) 
        VALUES (NULL, '$unitcode', '$unitname', '$year', '$trimester', '$classrep')";
        $result = $this->conn->query($sql_cat_marks_view);

        $unitdetailslastinsertid = $this->conn->insert_id;
        
        $tt = "INSERT INTO `unit_files_location` (`id`, `outline`, `no_of_chapters`, `chapter_1`, `chapter_2`, `chapter_3`, `chapter_4`, `chapter_5`, `chapter_6`, `chapter_7`, `chapter_8`, `chapter_9`, `chapter_10`, `chapter_11`, `chapter_12`, `chapter_13`) 
                                          VALUES ('$unitdetailslastinsertid', '', '$NOC', '', '', '', '', '', '', '', '', '', '', '', '', '')";
        $result1 = $this->conn->query($tt);
    }
    public function sendMessage($classrepid,$message){
      

        $sql_cat_marks_view ="INSERT INTO `notifiication` (`id`, `class_rep_id`, `message`)
         VALUES (NULL, '$classrepid', '$message')";
        //implement send to email later
        $result = $this->conn->query($sql_cat_marks_view);
    }
    public function UploadNotes($unitcode,$message){
      

        $sql_cat_marks_view ="UPDATE `unit_files_location` SET 
        `id`='[value-1]',
        `outline`='[value-2]',
        `no_of_chapters`='[value-3]',
        `chapter_1`='[value-4]',
        `chapter_2`='[value-5]',
        `chapter_3`='[value-6]',
        `chapter_4`='[value-7]',
        `chapter_5`='[value-8]',
        `chapter_6`='[value-9]',
        `chapter_7`='[value-10]',
        `chapter_8`='[value-11]',
        `chapter_9`='[value-12]',
        `chapter_10`='[value-13]',
        `chapter_11`='[value-14]',
        `chapter_12`='[value-15]',
        `chapter_13`='[value-16]' 
        WHERE id= $unitcode";
        //implement send to email later
        $result = $this->conn->query($sql_cat_marks_view);
    }
    
    
}
?>