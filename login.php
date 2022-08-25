<?php 
session_start();
include"./Connection/connection_test.php";
if(isset($_POST['Name']) && isset($_POST['Password'])){
    
    function validate($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
}
    $name=validate($_POST['Name']);
    $pass=validate($_POST['Password']);

    if(empty($name)){
        header("Location:index.php?error=User Name is required");
        exit();
    }else if(empty($pass)){
        header("Location:index.php?error=Password is required");
        exit();
    }
        $sql="SELECT * FROM student_login WHERE Student_name='$name' AND Student_password='$pass'";
       
        $result=mysqli_query($con,$sql);
        
        if(mysqli_num_rows($result)===1){
            $row=mysqli_fetch_assoc($result);
            if($row['Student_name']===$name && $row['Student_password']===$pass){
                echo "login successful";
                header("Location:/Syllabus/syllabus.html");
                exit();
            }else{ 
                header("Location:index.php?error=Incorrect User name or Password");
                exit();
            }
        }
         else{ 
    header("Location:index.php");
    exit();
}
?>