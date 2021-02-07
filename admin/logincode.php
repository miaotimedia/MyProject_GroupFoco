<?php
include('security.php');

if(isset($_POST['login_btn'])){
    $email_login=$_POST['email'];
    $password_login=$_POST['password'];


    $pass_query="SELECT password FROM register WHERE email='$email_login' ";
    $pass_query_run=mysqli_query($connection,$pass_query);
    
    if(mysqli_num_rows($pass_query_run) > 0){

        $hashpassword=mysqli_fetch_array($pass_query_run);

        if(password_verify($password_login, $hashpassword['password'])){

            $info_query="SELECT * FROM register WHERE email='$email_login' ";
            $info_query_run=mysqli_query($connection,$info_query);
            

            $_SESSION['useremail']=$email_login;//this used to be $_SESSION['userename']
            
            foreach($info_query_run as $row){
                $_SESSION['usertype']=$row['usertype'];
                $_SESSION['group']=$row['group_id'];
                $_SESSION['user_id']=$row['id'];
                $_SESSION['username']=$row['username']; 
                $user_icon=$row['user_icon'];
                if(!$user_icon){
                    $_SESSION['user_icon']="default_user_icon.png";
                }else{
                    $_SESSION['user_icon']=$user_icon;
                }
            }

            if($_SESSION['usertype']=="teacher"){
                header('location:index.php');
            }else{
                header('location:../index.php');
            }
      
        }else{
            $_SESSION['status']='パスワードが違います。';
            $_SESSION['status_code'] = "error";
            header('location:login.php');
        }
}else{
    $_SESSION['status']='メールアドレスが違います。';
    $_SESSION['status_code'] = "error";
    header('location:login.php');
}


  

    
}



/*



$hashpassword=mysqli_fetch_array($pass_query_run);

  if(mysqli_num_rows($pass_query_run) > 0 && password_verify($password_login, $hashpassword['password'])){   

            $query="SELECT * FROM register WHERE email='$email_login' ";
            $query_run=mysqli_query($connection,$query);
            $usertypes=mysqli_fetch_array($query_run);

            if($usertypes['usertype'] == "leader"){
                $_SESSION['username']=$email_login;
                header('location:index.php');
            }else{
                $_SESSION['username']=$email_login;
                header('location:../index.php');
            }  

    }else{
        $_SESSION['status']='メールアドレスまたはパスワードが違います。';
        header('location:login.php');
    }

*/

?>

