<?php
include('security.php');

if(isset($_POST['register_save']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $group_id=$_POST['group_id'];
    $password = $_POST['password'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $usertype = $_POST['usertype'];

    $email_query = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $hashpassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO register (username,email,password,usertype,group_id) VALUES ('$username','$email','$hashpassword','$usertype','$group_id')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "ユーザーを追加しました。";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else 
            {
                $_SESSION['status'] = "ユーザーを追加できません。";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "パスワードは不一致でした。";
            $_SESSION['status_code'] = "error";
            header('Location: register.php');  
        }
    }

}

//register new user end

//update and delete user info
if(isset($_POST['register_update'])){
    $id=$_POST['edit_id'];
    $username=$_POST['edit_username'];
    $email=$_POST['edit_email'];
    $hashpassword = password_hash($_POST['edit_password'], PASSWORD_DEFAULT);
    $usertype_update = $_POST['update_usertype'];
    $group_update=$_POST['update_group'];

    $query="UPDATE register SET username='$username', email='$email',password='$hashpassword',usertype='$usertype_update', group_id='$group_update' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['status']="ユーザープロファイルを更新しました。";
        $_SESSION['status_code'] = "success";
        header('location:register.php');
    }else{
        $_SESSION['status']="ユーザープロファイルの更新を失敗しました。";
        $_SESSION['status_code'] = "error";
        header('location:register.php');
    }

}


if(isset($_POST['register_delete'])){
    $id=$_POST['delete_id'];
    $query="DELETE FROM register WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['status']="ユーザープロファイルを削除しました。";
        $_SESSION['status_code'] = "success";
        header('location:register.php');
    }else{
        $_SESSION['status']="ユーザープロファイルの削除を失敗しました。";
        $_SESSION['status_code'] = "error";
        header('location:register.php');
    }
}
//update and delete user info end


//add about
if(isset($_POST['about_save'])){
    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];
    $links = $_POST['links'];

    $query = "INSERT INTO about (title, subtitle, description, links) VALUES ('$title', '$subtitle', '$description','$links')";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION['status']= "伝達事項を追加しました。";
        $_SESSION['status_code'] = "success";
        header('location: about.php');
    }else{
        $_SESSION['status']= "伝達事項の追加を失敗しました。";
        $_SESSION['status_code'] = "error";
        header('location: about.php');
    }
}

//update and delete about
if(isset($_POST['about_update'])){
    $id=$_POST['edit_id'];
    $title=$_POST['edit_title'];
    $subtitle=$_POST['edit_subtitle'];
    $description=$_POST['edit_description'];
    $links= $_POST['edit_links'];

    $query="UPDATE about SET title='$title', subtitle='$subtitle',description='$description',links='$links' WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['status']="伝達事項を更新しました。";
        $_SESSION['status_code'] = "success";
        header('location:about.php');
    }else{
        $_SESSION['status']="伝達事項の更新を失敗しました。";
        $_SESSION['status_code'] = "error";
        header('location:about.php');
    }

}

if(isset($_POST['about_delete'])){
    $id=$_POST['delete_id'];
    $query="DELETE FROM about WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['status']="伝達事項を削除しました。";
        $_SESSION['status_code'] = "success";
        header('location:about.php');
    }else{
        $_SESSION['status']="伝達事項の削除を失敗しました。";
        $_SESSION['status_code'] = "error";
        header('location:about.php');
    }
}

//About end

//Add Updates


//Delete Updates
if(isset($_POST['updates_delete'])){
    $id=$_POST['delete_id'];
    $get_filepath="SELECT * FROM updates WHERE id = '$id'";
    $get_filepath_run = mysqli_query($connection, $get_filepath);

    foreach($get_filepath_run as $row){
        $filepath="upload/".$row['file'];
    }

    $query="DELETE FROM updates WHERE id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        unlink($filepath);
        $_SESSION['status']="タスクを削除しました。";
        $_SESSION['status_code'] = "success";
        header('location:updates.php');
    }else{
        $_SESSION['status']="タスクの削除を失敗しました。";
        $_SESSION['status_code'] = "error";
        header('location:updates.php');
    }
}

if(isset($_POST['search_data'])){
    $id = $_POST['id'];
    $visible = $_POST['visible'];

    $query = "UPDATE updates SET visible = '$visible' WHERE id='$id' ";
    $query_run = mysqli_query($connection,$query);
}

if(isset($_POST['delete_multiple_data'])){
    $vid = "1";
    $get_multi_filepath="SELECT * FROM updates WHERE visible = '$vid'";
    $get_multi_filepath_run = mysqli_query($connection, $get_multi_filepath);

    while($row = mysqli_fetch_assoc($get_multi_filepath_run)){
        $filenames[]=$row['file'];
    }
   
    $query = "DELETE FROM updates WHERE visible='$vid' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        foreach($filenames as $filename){
            unlink("upload/".$filename);
        }
        $_SESSION["status"] = "タスクを削除しました。";
        $_SESSION['status_code'] = "success";
        header("location: updates.php");
    }else{
        $_SESSION["status"] = "タスクの削除を失敗しました。";
        $_SESSION['status_code'] = "error";
        header("location: updates.php");
    }
}

//Delete Q&A 
if(isset($_POST['q&a_delete'])){
    $id=$_POST['delete_id'];
    $get_filepath="SELECT * FROM q_and_a WHERE post_id = '$id'";
    $get_filepath_run = mysqli_query($connection, $get_filepath);

    foreach($get_filepath_run as $row){
        $filepath="upload/".$row['file'];
    }

    $query="DELETE FROM q_and_a WHERE post_id='$id'";
    $query_run = mysqli_query($connection, $query);

    $delete_comments="DELETE FROM comments WHERE post_id='$id'";

    if($query_run){
        unlink($filepath);
        $query_run = mysqli_query($connection, $delete_comments);
        $_SESSION['status']="Q&Aを削除しました。";
        $_SESSION['status_code'] = "success";
        header('location:updates.php');
    }else{
        $_SESSION['status']="Q&Aの削除を失敗しました。";
        $_SESSION['status_code'] = "error";
        header('location:updates.php');
    }
}

if(isset($_POST['search_data'])){
    $id = $_POST['id'];
    $visible = $_POST['visible'];

    $query = "UPDATE q_and_a SET visible = '$visible' WHERE post_id='$id' ";
    $query_run = mysqli_query($connection,$query);
}


if(isset($_POST['delete_multiple_data_q&a'])){
    $vid = "1";
    $get_multi_filepath="SELECT * FROM q_and_a WHERE visible = '$vid'";
    $get_multi_filepath_run = mysqli_query($connection, $get_multi_filepath);

    while($row = mysqli_fetch_assoc($get_multi_filepath_run)){
        $filenames[]=$row['file'];
        $comments_post_id[]=$row['post_id'];
    }
   
    $query = "DELETE FROM q_and_a WHERE visible='$vid' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        foreach($filenames as $filename){
            unlink("upload/".$filename);
        }
        foreach($comments_post_id as $comment_post_id){
            $delete_comments="DELETE FROM comments WHERE post_id='$comment_post_id'";
            $delete_comments_run = mysqli_query($connection, $delete_comments);
        }
        $_SESSION["status"] = "Q&Aを削除しました。";
        $_SESSION['status_code'] = "success";
        header("location: q_and_a.php");
    }else{
        $_SESSION["status"] = "Q&Aの削除を失敗しました。";
        $_SESSION['status_code'] = "error";
        header("location: q_and_a.php");
    }
}


//Delete Comments

if(isset($_POST['comments_delete'])){
    $id=$_POST['delete_id'];
    $get_filepath="SELECT * FROM comments WHERE comment_id = '$id'";
    $get_filepath_run = mysqli_query($connection, $get_filepath);

    $query="DELETE FROM comments WHERE comment_id ='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $_SESSION['status']="コメントを削除しました。";
        $_SESSION['status_code'] = "success";
        header('location:updates.php');
    }else{
        $_SESSION['status']="コメントの削除を失敗しました。";
        $_SESSION['status_code'] = "error";
        header('location:updates.php');
    }
}

if(isset($_POST['search_data'])){
    $id = $_POST['id'];
    $visible = $_POST['visible'];

    $query = "UPDATE comments SET visible = '$visible' WHERE comment_id='$id' ";
    $query_run = mysqli_query($connection,$query);
}


if(isset($_POST['delete_multiple_data_comments'])){
    $vid = "1";
    $get_multi_filepath="SELECT * FROM comments WHERE visible = '$vid'";
   
    $query = "DELETE FROM comments WHERE visible='$vid' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION["status"] = "コメントを削除しました。";
        $_SESSION['status_code'] = "success";
        header("location: q_and_a.php");
    }else{
        $_SESSION["status"] = "コメントの削除を失敗しました。";
        $_SESSION['status_code'] = "error";
        header("location: q_and_a.php");
    }
}
?>
