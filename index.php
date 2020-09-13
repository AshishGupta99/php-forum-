<?php
if (isset($_GET['user'])) {
  session_start();
  $_SESSION['username'] = $_GET['user'];
}
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>IT-forum</title>

</head>
<body style="background:black;">
  <?php include 'partials/_navbar.php'; ?>

  <?php include 'partials/_dbconnect.php'; ?>

  <?php
  if (isset($_GET['user'])) {

    echo '
      <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
  <strong>Success!</strong><br> you are logged in. '.$_SESSION["username"].'<br>welcome <strong>'.$_GET['user'].'</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  ';
  } else {
    if (isset($_GET['success'])) {
      echo '
      <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
  <strong>Error!</strong><br> '.$_GET['success'].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  ';
    }
  }

  ?>


  <!-- slider starts here-->

  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="5"></li>

    </ol>
    <div class="carousel-inner" data-interval="1000" style="height:10%">
      <div class="carousel-item active" data-interval="1500">
        <img src="1.jpeg" class="d-block w-100" alt="...">
      </div>

      <div class="carousel-item" data-interval="1500">
        <img src="2.jpeg" class="d-block w-100" alt="...">
      </div>

      <div class="carousel-item" data-interval="1500">
        <img src="3.jpeg" class="d-block w-100" alt="...">
      </div>

      <div class="carousel-item" data-interval="1500">
        <img src="4.jpeg" class="d-block w-100" alt="...">
      </div>

      <div class="carousel-item" data-interval="1500">
        <img src="5.jpeg" class="d-block w-100" alt="...">
      </div>

      <div class="carousel-item" data-interval="1500">
        <img src="6.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
  </div>


  <!-- catagory container start here-->
  <div class="container" style="min-height:70vh; margin-top:2%;">
    <h2 class="text-center text-light">IT-forum brows categories</h2>

    <!--fetch all the categories here-->
    <?php

    $showResult = true;
    $sql = "SELECT * FROM `categories`";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
      //echo $row['catagory_id'];
      //echo $row['catagory_name'];
      //echo "<br>";

      $id = $row['catagory_id'];
      $U = $_GET['user'];
      echo '
            <div class="card mb-3" style="background-size:cover; margin:2%; background:rgba(255,255,255,0.9); border:1px solid #25D366;">
              <a href="';
      if (isset($_GET['user'])) {

        echo '
              threadList.php?catId='.$id.'&user='.$U.'">';
      } else {
        echo '
                threadList.php?catId='.$id.'">';
      }


      echo ' <div class="row no-gutters">';
      $cat = $row['catagory_name'];
      $desc = $row['catagory_description'];
      echo '
              <!--use for loop for itrate categorie-->
              <!--<div class="col-md-4">-->
              <img src="https://source.unsplash.com/1600x900/?'.$cat.',programming" style="background-size:cover; padding:3%;" class="card-img" alt="image">
              <!--</div>-->
                <a href="';

      if (isset($_GET['user'])) {

        echo '
                 threadList.php?catId='.$id.'&user='.$U.'">';
      } else {
        echo '
                 threadList.php?catId='.$id.'">';
      }

      //view discussions button
      echo ' <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title"><a style="color:#B388FF" href="';

      if (isset($_GET['user'])) {

        echo '
                   threadList.php?catId='.$id.'&user='.$U.'">';
      } else {
        echo '
                    threadList.php?catId='.$id.'">';
      }



      echo $cat.'</a></h5>
                  <p class="card-text">'.$desc.'</p>
                  <a href="';

      if (isset($_GET['user'])) {

        echo '
              threadList.php?catId='.$id.'&user='.$U.'"';
      } else {
        echo '
                threadList.php?catId='.$id.'"';
      }

      echo 'class="btn btn-primary" style="margin-bottom:0; margin-top:0;">View Discussions</a>
                </div>
             </div>
                </a>
              </div>
            </div>
          ';

    }


    ?>
  </div>
</a>

<?php
include 'partials/_loginmodal.php';
include 'partials/_signupmodal.php';
?>
<hr style="background:gray; width:90%">

<?php
//user creat forum after filling this form
if (isset($_GET['user'])) {
  echo '
      <div style="margin:5%">
         <form>
           <div class="form-group">
             <label for="thd_title" style="color:gray">Topic of catagory</label>
             <input type="text" required class="form-control" style="background:transparent; color:#BBDEFB;" id="thd_title" name="thd_title" placeholder="name of programming language...">
           </div>
           <br>
           <div class="form-group">
             <label for="thd_desc" style="color:gray">Discription of catagory</label>
             <textarea class="form-control" required id="thd_desc" style="background:transparent; color:#BBDEFB;" name="thd_desc" placeholder="type the description..."></textarea>
           </div>
           <button type="button" class="btn btn-outline-primary">post</button>
          </form>
      </div>
      ';
}
?>

<?php include 'partials/_footer.php'; ?>



<script>
  function go() {
    window.location.href = "index.php";
  }


  function logout() {
    window.location.href = "partials/_logout.php";

    //important
    window.location.replace('/MyProjects/forumProject/');

    return false;
  }
</script>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>