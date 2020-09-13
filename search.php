<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>Your search results</title>
</head>
<body>

  <?php include 'partials/_navbar.php'; ?>

  <?php include 'partials/_dbconnect.php'; ?>
  
  <?php
  echo '<br>';
  $search = $_GET['search'];
  $sql = "SELECT * FROM threads WHERE MATCH (thread_title,thread_desc) against ('$search')"; //these line is important
  $result1 = mysqli_query($conn, $sql);

  $showResult = true;
  $noResult = true;
  while ($rowct = mysqli_fetch_assoc($result1)) {
    $showResult = false;
    $thread_id = $rowct['thread_id'];
    $thread_title = $rowct['thread_title'];
    $thread_desc = $rowct['thread_desc'];
    $date = $rowct['date'];
    $noResult = false;


    //sql for displaying user name
    $user_id = $rowct['thread_user_id'];
    $sql3 = "SELECT username FROM `users` WHERE sr=$user_id";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);



    echo '
             <div class="media" style="margin:2%; background:#EEEEEE">
               <div class="media-body" style="margin:2%">
                 <h5 class="mt-0 mb-1"><a href="';
    if (isset($_GET['user'])) {

      echo '
                 thread.php?threadId='.$thread_id.'&user='.$_GET['user'].'"';
    } else {
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
  if($noResult){
    echo '
   <p> No results containing all your search terms were found.
Your search -"'.$search.'"- did not match any documents.<p>
<strong>Suggestions:</strong>
<p>Make sure that all words are spelled correctly.</p>
<p>
<ul>
<li>Try different keywords.</li>
<li>Try more general keywords.</li>
<li>Try fewer keywords.</li>
</ul></p>
';
  }
  ?>

  <?php include 'partials/_footer.php'; ?>

  <?php
  include 'partials/_loginmodal.php';
  include 'partials/_signupmodal.php';
  ?>

  <script>
    function go() {
      window.location.href = "index.php";
    }
  </script>
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