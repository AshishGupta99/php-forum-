<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>all answers</title>
</head>
<body>
  <?php include 'partials/_navbar.php'; ?>

  <?php include 'partials/_dbconnect.php'; ?>

  <br>
  <?php
  $t_id = $_GET['threadId'];
  $sql = "SELECT * FROM `threads` WHERE thread_id=$t_id"; //these line is important
  $result1 = mysqli_query($conn, $sql);
  while ($rowct = mysqli_fetch_assoc($result1)) {
    $title = $rowct['thread_title'];
    $desc = $rowct['thread_desc'];
    $date = $rowct['date'];


    //for displaying username in comments
    $user_id = $rowct['thread_user_id'];
    $sql3 = "SELECT username FROM `users` WHERE sr=$user_id";
    $result3 = mysqli_query($conn, $sql3);
    $row_usr = mysqli_fetch_assoc($result3);


    echo '
            <div class="card bg-light mb-3" style="box-size:cover;margin:5%">
               <div class="card-header">Question ask by <strong>'.$row_usr['username'].':</strong><br><small><i class="form-text text-muted">at '.$date.'</i></small>
               </div>
               <div class="card-body">
                 <h5 class="card-title">'.$title.'</h5>
                 <p class="card-text">'.$desc.'</p>
               </div>
            </div>
          ';
  }
  ?>
  <div class="container" style="min-height:50vh">

    <div class="container">
      <?php
      if (isset($_GET['user'])) {


        //$_SERVER['REQUEST_URI'] is use for submitting form in page where the form is present (self submitting)-->
        echo '
          <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">

             <div class="form-group">
                <label for="come">write your answer:</label>
                <textarea class="form-control" id="come" name="come" rows="3" placeholder="click here to type..."></textarea>
                <small id="emailHelp" class="form-text text-muted">Type your answers as comments and post😇</small>
             </div>

             <button type="submit" class="btn btn-primary">Post Answer</button>
          </form>';
      } else {
        echo '<p class="lead"><small><i>you are not loged in please login to post your answer</i></small></p>';
      }
      ?>
    </div>
    <hr style="width:100%;">

    <?php
    $method = $_SERVER['REQUEST_METHOD'];
    //echo $method;
    $showAlert = false;
    if ($method == 'POST') {
      //insert into db

      //query for user id
      $user_name = $_GET['user'];
      $u_sql = "SELECT sr FROM `users` WHERE username='$user_name'";

      $results = mysqli_query($conn, $u_sql);
      $row_usr = mysqli_fetch_assoc($results);
      $thread_user_id = $row_usr['sr'];

      $title = $_POST['come'];
      //preventing xss attack
      $title = str_replace('<', '&lt;', $title);
      $title = str_replace('>', '&gt;', $title);

      $sql2 = "INSERT INTO `comments` (`comment_id`, `comments`, `thread_id`, `user_id`, `date`) VALUES (NULL, '$title', '$t_id', '$thread_user_id', current_timestamp())";
      $result2 = mysqli_query($conn, $sql2);
      $showAlert = true;
    }
    ?>



    <?php

    $id = $_GET['threadId'];
    $sqlC = "SELECT * FROM `comments` WHERE thread_id=$id"; //these line is important
    $result1 = mysqli_query($conn, $sqlC);

    $showResult = true;
    echo '<h3 style="text-align:center">All Answers</h3>';
    while ($rowct = mysqli_fetch_assoc($result1)) {
      $showResult = false;
      $content = $rowct['comments'];
      $time_c = $rowct['date'];

      //for displaying username in comments
      $user_id = $rowct['user_id'];
      $sql3 = "SELECT username FROM `users` WHERE sr=$user_id";
      $result3 = mysqli_query($conn, $sql3);
      $row_usr = mysqli_fetch_assoc($result3);


      echo '
              <div class="media" style="margin:2%; background:#EEEEEE">
                <div class="media-body" style="margin:2%">
                  <p><strong><i>'.$row_usr['username'].'</strong><br><small>at '.$time_c.'</small></i></p>
                  <p>
                     '.$content.'
                  </p>
                </div>
                <img src="user.png" width="10%" style="margin:2%" class="ml-3" alt="you">
              </div>
            ';
    }

    if ($showResult) {
      echo '
              <div class="jumbotron jumbotron-fluid">
                 <div class="container">
                   <strong><i>No Answers found</i></strong>
                   <p class="lead"><i>Be the first person to give the answer</i></p>
                 </div>
              </div>';
    }
    ?>

  </div>

  <?php
  include 'partials/_loginmodal.php';
  include 'partials/_signupmodal.php';
  ?>

  <?php include 'partials/_footer.php'; ?>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <script>

    function logout() {
      window.location.href = "partials/_logout.php";

      //important
      window.location.replace('/MyProjects/forumProject/');

      return false;
    }
  </script>
</body>
</html>