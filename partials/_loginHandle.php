<?php
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
     include '_dbconnect.php';
     $email = $_POST['Email1'];
     $email = str_replace('<','&lt;',$email);
     $email = str_replace('>','&gt;',$email);
     
     $pass = $_POST['Password1'];
     //echo $email;
     //echo $pass;
     $login = false;
     $err = false;
     
     $qry = "SELECT * FROM `users` WHERE email='$email'";
     $result = mysqli_query($conn,$qry);
    
     $rows = mysqli_fetch_assoc($result);
     
     $user = $rows['username'];
     
     $num = mysqli_num_rows($result);
     if($num == 1){
       if(password_verify($pass,$rows['password'])){
         $login = true;
         session_start();
         $_SESSION['loggedIn'] = true;
         $_SESSION['username'] = $user;
         header("location: /MyProjects/forumProject/index.php?user=$user&success=true");
       }
       else{
         $err = "incorrect possword!";
          header("location: /MyProjects/forumProject/index.php?success=$err");
       }
     }
     else{
       $err = "incorrect Email!";
        header("location: /MyProjects/forumProject/index.php?success=$err");
    }
  }
?>