
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>welcome to IT-forum</title>
    
  </head>
  <body>
    <?php include 'partials/_navbar.php'; ?>

    <?php include 'partials/_dbconnect.php'; ?>

    <br>
    <?php
      $id = $_GET['catId'];
      $sq = "SELECT * FROM `categories` WHERE catagory_id=$id";
      $result = mysqli_query($conn,$sq);
   
      while($row = mysqli_fetch_assoc($result)){
        $catname = $row['catagory_name'];
        $catdesc = $row['catagory_description'];
      }
    ?>


    <!-- here the user asked questions-->
    <?php
      $method = $_SERVER['REQUEST_METHOD'];
      //echo $method;
      $showAlert = false;
      if($method == 'POST'){
         //insert into db
         
         //query for user id
         $usr_name = $_GET['user'];
         $u_sql = "SELECT sr FROM `users` WHERE username='$usr_name'";
         $results = mysqli_query($conn,$u_sql);
         $row_usr = mysqli_fetch_assoc($results);
         $thread_user_id = $row_usr['sr'];
         //
         
         $title = $_POST['Q_title'];
         $title = str_replace('<','&lt;',$title);
         $title = str_replace('>','&gt;',$title);
         //preventing xss attack
         $desc = $_POST['Q_desc'];
         $desc = str_replace('<','&lt;',$desc);
         $desc = str_replace('>','&gt;',$desc);
         
         $sql2 = "INSERT INTO `threads` (`thread_id`, `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`, `date`) VALUES (NULL, '$title', '$desc', '$id', '$thread_user_id', current_timestamp())";
         $result2 = mysqli_query($conn,$sql2);
         $showAlert = true;
      }
    ?>
    
    <?php
      if($showAlert){
        echo '
          <div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>Success!</strong> Your Question added successfully , please wait for community to respond
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
           </button>
          </div>
        ';
      }
    ?>
    <div class="container my-4">
      <div class="jumbotron">
        <h1 class="display-4" style="color:#00E676"><?php echo $catname;?> forums</h1>
        <p class="lead"><?php echo $catdesc;?></p>
        <hr class="my-4">
        <p>No Spam / Advertising / Self-promote in the forums.
          Do not post copyright-infringing material.
          Remain respectful of other members</p>
        <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
      </div> 
    </div>

    <div class="container">
      <h3>Start a Discussion</h3>
      
      
      <!--$_SERVER['REQUEST_URI'] is use for submitting form in page where the form is present (self submitting)-->
      <?php //if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true ){
     if(isset($_GET['user'])){
     echo '
      <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
         <div class="form-group">
           <label for="Q_title">Your Questions title:</label>
           <input type="text" class="form-control" id="Q_title" name="Q_title" aria-describedby="emailHelp">
           <small id="emailHelp" class="form-text text-muted">Your Question based on which topic , type here.</small>
         </div>
  
         <div class="form-group">
           <label for="Q_desc">Ask your Question:</label>
           <textarea class="form-control" id="Q_desc" name="Q_desc" rows="3"></textarea>
           <small id="emailHelp" class="form-text text-muted">Type your Question or problem related to your title.</small>
         </div>

         <button type="submit" class="btn btn-primary">Post Question</button>
      </form>';
      }
      else{
        echo '<p class="lead"><small style="color:#FF3D00"><i>you are not loged in please login to Start Discussion</i></small></p>';
      }
      ?>
    </div>

    <div class="container">
       <h1>browse Questions</h1>
  
  
  
       <?php
       //all questions here
       $id = $_GET['catId'];
       $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";//these line is important
       $result1 = mysqli_query($conn,$sql);
  
       $showResult = true;
       while($rowct = mysqli_fetch_assoc($result1)){
          $showResult = false;
          $thread_id = $rowct['thread_id'];
          $thread_title = $rowct['thread_title'];
          $thread_desc = $rowct['thread_desc'];
          $date = $rowct['date'];
          
          
          //sql for displaying user name
          $user_id = $rowct['thread_user_id'];
          $sql3 = "SELECT username FROM `users` WHERE sr=$user_id";
          $result3 = mysqli_query($conn,$sql3);
          $row3 = mysqli_fetch_assoc($result3);
          


          echo '
             <div class="media" style="margin:2%; background:#EEEEEE; border:1px solid #00B0FF">
               <div class="media-body" style="margin:2%">
                 <h5 class="mt-0 mb-1"><a href="';
                 if(isset($_GET['user'])){
                 
                 echo '
                
                 thread.php?threadId='.$thread_id.'&user='.$_GET['user'].'"';
                 }
                 else{
                  echo 'thread.php?threadId='.$thread_id.'"';
                 }
                 echo '
                 style="color:black">'.$thread_title.'</h5>
                 <small><i class="form-text text-muted">Ask by <strong>'.$row3['username'].'</strong> at '.$date.'</i></small>
                 <p>
                    '.$thread_desc.'
                 </p>
               </div></a>
               <img src="user.png" width="10%" style="margin:2%" class="ml-3" alt="you">
             </div>
           ';
        }
       //echo var_dump($showResult);
       if($showResult){
          echo '
             <div class="jumbotron jumbotron-fluid">
               <div class="container">
                 <strong><i>No Questions found</i></strong>
                 <p class="lead"><i>Be the first person to ask the question</i></p>
               </div>
             </div>
          ';
        }
      ?>

    <!--
       <div class="media" style="margin:2%; background:#EEEEEE">
          <div class="media-body" style="margin:2%">
             <h5 class="mt-0 mb-1">unable to install jupyter notebook error in android</h5>
             <p>
                If you don't know what that means, and don't want to find out, just (re)install Anaconda with the default settings, and it should set up PATH correctly. If Jupyter gives an error that it can't find notebook , check with pip or conda that the notebook package is installed. Try running jupyter-notebook
             </p>
          </div>
          <img src="user.png" width="10%" style="margin:2%" class="ml-3" alt="you">
       </div> 
    -->

    </div>
    
    <?php 
       include 'partials/_loginmodal.php';
       include 'partials/_signupmodal.php';
    ?>

    <?php include 'partials/_footer.php'; ?>

    <script>
        function go(){
            window.location.href="index.php";
        }
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script>
      
      function logout(){
        window.location.href="partials/_logout.php";
        
        //important
        window.location.replace('/MyProjects/forumProject/');
        
        return false;
      }
    </script>
  </body>
</html>