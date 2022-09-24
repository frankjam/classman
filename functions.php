<?php 
class databaseConnection{
  
}

class user{
    public function login($email,$password){
        $conn = new mysqli("localhost","root","","classman");

        $sql="SELECT * FROM `classrepdetails` WHERE `email` ='$email' AND `password` ='$password'";
        $result= $conn->query($sql);

        if($result->num_rows == 1){
            $row = $result->fetch_assoc();

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];

            header('location: index.php');
        }else{
            echo "incorrect password or email";
        }
    }
}

class units{
    public function units_view($ycws,$trimester){
        $conn = new mysqli("localhost","root","","classman");

        $sql_cat_marks_view ="SELECT * FROM `unitdetails`";
        $result = $conn->query($sql_cat_marks_view);
      
        if ($result->num_rows > 0) {
            $i = 1;
            while($row = $result->fetch_assoc()) {
                echo "<tr> 
                <td>".$i."</td>
                <td>".$row["unit_name"]."</td> 
                <td>".$row["unit_code"]."</td> 
                <td><a href='unitview.php?viewunit=".base64_encode($row["id"])."'>View details </a></td>
                </tr>";
                $i++;
            }  
        } else{
            echo "<tr> <td colspan='4' class='text-center py-4 text-info'> Check later  </td> </tr>";
        }
    }
    public function detailed_unit_view($unitid){
        $conn = new mysqli("localhost","root","","classman");

        $sql_cat_marks_view ="SELECT * FROM `unit_files_location` LEFT OUTER JOIN unitdetails on unitdetails.id = unit_files_location.id WHERE unitdetails.id =$unitid";
        $result = $conn->query($sql_cat_marks_view);
      
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr> 
                <td>".$row["unit_name"]."</td> 
                <td>".$row["unit_code"]."</td></tr>
                <tr> <td> Outline : <a href='".$row["outline"]."' download class='btn btn-dark' >Download </a></td> </tr>";
                for($i = 1; $i<=$row["no_of_chapters"]; $i++){
                    if($row["chapter_$i"] == NULL){
                        break;
                    }
                    echo "<tr> 
                    <td> Chaper $i: <a href='".$row["chapter_$i"]."' download >Download </a></td>
                    </tr>";
                }
            }
        } else{
            echo "<tr> <td colspan='4' class='text-center py-4 text-info'> Check later  </td> </tr>";
        }
    }
}
?>