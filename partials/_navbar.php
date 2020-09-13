 <?php  
echo  '<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
      
     <img src="logo.png" class="row" height="10%" width="10%" onclick="go()">
  <a class="row navbar-brand" href="index.php">discussion forum Bsc.IT.</a>
 
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">about</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Category
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php" tabindex="-1">contact</a>
      </li>
    </ul>
    
      <div class="row" style="margin-top:0; margin-left:auto;">
    <form class="form-inline my-2 my-lg-0" style="align-items:center" action="';
    if(isset($_GET['user'])){
      $usr = $_GET['user'];
      echo "search.php";
    }
    else{
      echo "search.php";
    }
    echo '">
      <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" style="margin-right:20px" type="submit">Search</button>
    </form>';
     //logined user
     
     if(isset($_GET['user'])){
     
      $usr = $_GET['user'];
       echo 'Welcome to it forum '.$usr.'';
      echo '
      <button class="btn btn-primary" type="button" onclick="logout()">logout</button>
      
      ';
       
       echo '</nav>';
       
     }
 
       else{ 
    echo '<button class="row btn btn-primary" style="margin:0;" data-toggle="modal" data-target="#loginModal">login</button>
    <p style="color:white; margin-left:10px; margin:10px;">or</p>
    <button class="row btn btn-primary" style="margin:0" data-toggle="modal" data-target="#signModal">create New account</button>
          </div>
  </div>
</nav>';
       }
echo "<br><br>";

if(isset($_GET['successError']) == "true"){
echo '
  <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
  <strong>your Account created successfully!</strong><br>now you can login.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  ';
}

/*
if(isset($_GET['user'])){
  echo '
      <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
  <strong>Success!</strong><br> you are logged in.<br>welcome <strong>'.$_GET['user'].'</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  ';
}
else{
  if(isset($_GET['success'])){
  echo '
      <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
  <strong>Error!</strong><br> '.$_GET['success'].'
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
  ';}
}*/

?>