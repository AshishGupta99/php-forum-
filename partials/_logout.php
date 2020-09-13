<?php
session_start();
//echo "login out please wait...";
session_destroy();

header("location: /MyProjects/forumProject/");

?>