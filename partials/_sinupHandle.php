<?php
   //echo "this page<br>";
   
   if($_SERVER['REQUEST_METHOD'] == 'POST'){
     include '_dbconnect.php';
     // echo var_dump($conn);
     $username = $_POST['username'];
     $username = str_replace('<','&lt;',$username);
     $username = str_replace('>','&gt;',$username);
     
     $Email = $_POST['Email'];
     $Email = str_replace('<','&lt;',$Email);
     $Email = str_replace('>','&gt;',$Email);
     
     $pass = $_POST['pass'];
     $cpass = $_POST['cpass'];
     //echo $cpass."<br>".$pass."<br>".$username."<br>".$Email;

     $qr = "SELECT * FROM `users` WHERE email='$Email'";
     $run = mysqli_query($conn,$qr);
     $num_of_rows = mysqli_num_rows($run);
     
     if($num_of_rows > 0){
       $showError = "sorry! email is already in use";
     }
     else{
       if($cpass == $pass){
          //  echo "<br>password match";
          $hash = password_hash($pass, PASSWORD_DEFAULT);
          $sq = "INSERT INTO `users` (`email`, `username`, `password`, `date`) VALUES ('$Email', '$username', '$hash', current_timestamp())";
          $result = mysqli_query($conn,$sq);
          
          if($result){
             $showAlert = true;
             header("Location: /MyProjects/forumProject/index.php?successError=true");
             exit();
        
          }
    
        }
        
       else{
          echo "<br>password do not match";
       }
     
     }
   }
?>