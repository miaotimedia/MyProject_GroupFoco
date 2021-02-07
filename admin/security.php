<?php
session_start();
include('database/dbconfig.php');

if($dbconfig){
    //echo"データベースへの接続は成功しました。";  header('location:../index.php');
}else{
    header('location:database/dbconfig.php');
}

if(!$_SESSION['username']){
    header('location:login.php');
}

if($_SESSION['group']){
    $group_id=$_SESSION['group'];
}



?>