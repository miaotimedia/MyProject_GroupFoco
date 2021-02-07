<?php
include('security.php');?>

<?php
if($_SESSION['usertype']!== "teacher"){
  header('location:../index.php');
}
?>

<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container-fluid">


  <div class="row">
    <div class="p-0 m-0">
    <img  class="img-fluid" src="./images/welcome.png" alt="welcome" style="">
    </div>
  </div>

</div>






  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>