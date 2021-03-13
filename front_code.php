<?php include('admin/security.php');

//ADD updates
if(isset($_POST['updates_save'])){
    $group_id = $_SESSION['group'];
    $title = $_POST['updates_title'];
    $description = $_POST['updates_description'];
    $file = $_FILES["updates_file"]['name'];
    $rawdate = htmlentities($_POST['updates_due']);
    $due_date = date('Y-m-d', strtotime($rawdate));
    $visiablity=0;
    $priority=$_POST["priority"];
    $prioritization=$_POST["prioritization"];

   
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    $ext=strtolower($extension);
    $validate_file_extension= in_array($ext, ['zip', 'pdf', 'docx','doc','txt','xlsx','jpg','jpeg','png','gif','php','html','css','js']);

    if($file!=NULL){ 
        if($validate_file_extension){
            if(file_exists("admin/upload/".$_FILES["updates_file"]["name"])){
                $store = $_FILES["updates_file"]["name"];
                $_SESSION['status']="ファイル. '$store'.は既に存在しています。"; 
                $_SESSION['status_code'] = "error";
                header('location: updates.php');
            }
        }else{
             $_SESSION['status']= "ファイル拡張子は正しくありません。";
             $_SESSION['status_code'] = "error";
             header('location: updates.php');
        }
    }
    
    $query = "INSERT INTO updates (title, description, file, group_id, visible, update_date, due_date, priority, prioritization) VALUES ('$title', '$description','$file','$group_id', '$visiablity',CURRENT_DATE(), '$due_date','$priority','$prioritization')";
    $query_run = mysqli_query($connection,$query);
     
    if($query_run){ //modified
         if($file == NULL){
                $_SESSION['status']= "伝達事項を作成しました。";
                $_SESSION['status_code'] = "success";
                header('location: updates.php');
         }else{
              move_uploaded_file($_FILES["updates_file"]["tmp_name"], "admin/upload/".$_FILES["updates_file"]["name"]);
              $_SESSION['status']= "伝達事項を作成しました。";
              $_SESSION['status_code'] = "success";
              header('location: updates.php');
         }
    }else{
        $_SESSION['status']= "伝達事項を作成できません。";
        $_SESSION['status_code'] = "error";
        header('location: updates.php');
    }

    
}

//Edit updates
if(isset($_POST['updates_update'])){

    $id=$_POST['edit_id'];
    $title=$_POST['edit_title'];
    $description=$_POST['edit_description'];
    $file = $_FILES["update_file"]['name'];
    $rawdate = htmlentities($_POST['edit_due']);
    $due_date = date('Y-m-d', strtotime($rawdate));
    $priority=$_POST["priority"];
    $prioritization=$_POST["prioritization"];
    

    $extension = pathinfo($file, PATHINFO_EXTENSION);
    $ext=strtolower($extension);
    $validate_file_extension= in_array($ext, ['zip', 'pdf', 'docx','doc','txt','xlsx','jpg','jpeg','png','gif','php','html','css','js','']);


    if($validate_file_extension){
        $updates_query="SELECT * FROM updates WHERE id = '$id'";
        $updates_query_run=mysqli_query($connection,$updates_query);
    
        foreach($updates_query_run as $up_row){
            
            if($file == NULL){
                $file_data=$up_row['file'];
            }else if($file_path="admin/upload/".$up_row['file']){
                if(file_exists("admin/upload/".$_FILES["update_file"]["name"])){
                    $store = $_FILES["update_file"]["name"];
                    $_SESSION['status']="ファイル. '$store'.は既に存在しています。";
                    $_SESSION['status_code'] = "error";
                    header('location: updates.php');
                    exit;
                }else{
                    unlink($file_path);
                    $file_data=$file;
                }
            }
        }
        $query="UPDATE updates SET title='$title',description='$description',file='$file_data', due_date='$due_date',priority='$priority', prioritization='$prioritization' WHERE id='$id'";
        $query_run = mysqli_query($connection, $query);
    
        if($query_run){
            if($file == NULL){
                $_SESSION['status']="伝達事項を編集しました。";
                $_SESSION['status_code'] = "success";
                header('location:updates.php');
            }else{
                move_uploaded_file($_FILES["update_file"]["tmp_name"], "admin/upload/".$_FILES["update_file"]["name"]);
                $_SESSION['status']="伝達事項を編集しました。";
                $_SESSION['status_code'] = "success";
                header('location:updates.php');
            }
            
        }else{
            $_SESSION['status']="伝達事項の編集を失敗しました。";
            $_SESSION['status_code'] = "error";
            header('location:updates.php');
        }
        
    
    }else{
        $_SESSION['status']= "ファイル拡張子は正しくありません。";
        $_SESSION['status_code'] = "error";
        header('location: updates.php');
    }     

}



//ADD q_and_a

if(isset($_POST['q&a_save'])){
    $group_id=$_POST['group_id'];
    $poster_id=$_POST['poster_id'];
    $title = $_POST['q&a_title'];
    $description = $_POST['q&a_description'];
    $file = $_FILES["q&a_file"]['name'];
    
   
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    $ext=strtolower($extension);
    $validate_file_extension= in_array($ext, ['zip', 'pdf', 'docx','doc','txt','xlsx','jpg','jpeg','png','gif','php','html','css','js']);

    if($file!=NULL){ 
        if($validate_file_extension){
            if(file_exists("admin/upload/".$_FILES["updates_file"]["name"])){
                $store = $_FILES["updates_file"]["name"];
                $_SESSION['status']="ファイル. '$store'.は既に存在しています。"; 
                $_SESSION['status_code'] = "error";
                header('location: q_and_a.php');
            }
        }else{
             $_SESSION['status']= "ファイル拡張子は正しくありません。";
             $_SESSION['status_code'] = "error";
             header('location: q_and_a.php');
        }
    }
    

    $query = "INSERT INTO q_and_a (title, description, file, poster_id, post_date,group_id) VALUES ('$title', '$description','$file','$poster_id',NOW(),'$group_id')";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        if($file == NULL){
            $_SESSION['status']= "Q&Aを作成しました。";
            $_SESSION['status_code'] = "success";
            header('location: q_and_a.php');
        }else{
            move_uploaded_file($_FILES["q&a_file"]["tmp_name"], "admin/upload/".$_FILES["q&a_file"]["name"]);
            $_SESSION['status']= "Q&Aを作成しました。";
            $_SESSION['status_code'] = "success";
            header('location: q_and_a.php');
        }
    }else{
        $_SESSION['status']="Q&Aの作成を失敗しました。";
        $_SESSION['status_code'] = "error";
        header('location:q_and_a.php');
    }

    
}

//Edit Q&A
if(isset($_POST['q_and_a_update'])){

    $id=$_POST['edit_id'];
    $title=$_POST['edit_title'];
    $description=$_POST['edit_description'];
    $file = $_FILES["update_file"]['name'];    

    $extension = pathinfo($file, PATHINFO_EXTENSION);
    $ext=strtolower($extension);
    $validate_file_extension= in_array($ext, ['zip', 'pdf', 'docx','doc','txt','xlsx','jpg','jpeg','png','gif','php','html','css','js','']);


    if($validate_file_extension){
        $updates_query="SELECT * FROM q_and_a WHERE post_id = '$id'";
        $updates_query_run=mysqli_query($connection,$updates_query);
    
        foreach($updates_query_run as $up_row){
            if($file == NULL){
                $file_data=$up_row['file'];
            }else if(file_exists("admin/upload/".$_FILES["update_file"]["name"])){
                    $store = $_FILES["update_file"]["name"];
                    $_SESSION['status']="ファイル. '$store'.は既に存在しています。";
                    $_SESSION['status_code'] = "error";
                    header('location: q_and_a.php');
                    exit;
            }else{
                $file_path="admin/upload/".$up_row['file'];
                unlink($file_path);
                $file_data=$file;
            }
        }
        
        $query="UPDATE q_and_a SET title='$title',description='$description',file='$file_data' WHERE post_id='$id'";
        $query_run = mysqli_query($connection, $query);
    
        if($query_run){

            if($file == NULL){
                $_SESSION['status']="Q&Aを編集しました。";
                $_SESSION['status_code'] = "success";
                header('location:q_and_a.php');
            }else{
                move_uploaded_file($_FILES["update_file"]["tmp_name"], "admin/upload/".$_FILES["update_file"]["name"]);
                $_SESSION['status']="Q&Aを編集しました。";
                $_SESSION['status_code'] = "success";
                header('location:q_and_a.php');
            }
            
        }else{
            $_SESSION['status']="Q&Aの編集を失敗しました。";
            $_SESSION['status_code'] = "error";
            header('location:q_and_a.php');
        }
        
    
    }else{
        $_SESSION['status']= "ファイル拡張子は正しくありません。";
        $_SESSION['status_code'] = "error";
        header('location: q_and_a.php');
    }  

}

//ユーザー情報変更
if(isset($_POST['edit_userinfo'])){
    $user_id=$_POST['user_id'];
    $username=$_POST['username'];
    $email=$_POST['email'];
    $old_password=$_POST['old_password'];
    $new_password=$_POST['new_password'];
    $user_icon = $_FILES["user_icon"]['name'];

    $extension = pathinfo($user_icon, PATHINFO_EXTENSION);
    $ext=strtolower($extension);
    $validate_file_extension= in_array($ext, ['jpg','jpeg','png','gif']);

    if($validate_file_extension){ //check file's extension
        $get_icon="SELECT * FROM register WHERE id = '$user_id'";
        $get_icon_run=mysqli_query($connection,$get_icon);
    
        foreach($get_icon_run as $get_row){
            if($user_icon == NULL){ //if no file is uploaded
                $user_icon_file=$get_row['user_icon'];
            }else if($file_path="admin/upload/".$get_row['user_icon']){
                if(file_exists("admin/upload/".$_FILES["user_icon"]["name"])){ //if file is uploaded but file name already exists
                    $store = $_FILES["user_icon"]["name"];
                    $_SESSION['status']="ファイル. '$store'.は既に存在しています。";
                    $_SESSION['status_code'] = "error";
                    header('location: user_info.php');
                    exit;
                }else{
                    $user_icon_file=$user_icon;//file passes all checks
                }
            }
        }

        $get_pw="SELECT password FROM register WHERE id=$user_id"; 
        $get_pw_run=mysqli_query($connection,$get_pw);

        if(mysqli_num_rows($get_pw_run) > 0){
            $hashpassword=mysqli_fetch_array($get_pw_run);
            if(password_verify($old_password, $hashpassword['password'])){  //check old password
                $hash_new_pw = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE register SET username='$username', email='$email',password='$hash_new_pw',user_icon='$user_icon_file' WHERE id=$user_id";
                $query_run = mysqli_query($connection,$query);

                if($query_run){
                    move_uploaded_file($_FILES["user_icon"]["tmp_name"], "admin/upload/".$_FILES["user_icon"]["name"]);
                    unlink($file_path); //delete old user_icon
                    $_SESSION['status']= "ユーザー情報を更新しました。";
                    $_SESSION['status_code'] = "success";
                    header('location: user_info.php');
                }else{
                    $_SESSION['status']= "ユーザー情報を更新できませんでした。";
                    $_SESSION['status_code'] = "error";
                    header('location: user_info.php');
                }
            }else{
                $_SESSION['status']= "旧パスワードが間違っています";
                $_SESSION['status_code'] = "error";
                header('location: user_info.php');
            }
        }   
    }else{
        $_SESSION['status']= "jpg, jpeg, png, gifをアップロードしてください！";
        $_SESSION['status_code'] = "error";
        header('location: user_info.php');
    }
}

// ADD attendance
if(isset($_POST['attendance'])){
    if($_POST['class']!=""){
        $class=$_POST['class'];
        $day=$_POST['day'];
        $time_range=$_POST['time_range'];
        $group_id=$_POST['group_id'];

        if($_POST['att_check']!=""){
            $att_check = implode("、", $_POST['att_check']);
        }else{
            $att_check="全員出席";
        }

        $query="INSERT INTO attendance (class, class_day, time_range, student_attend, group_id, date_time) VALUES ('$class','$day','$time_range','$att_check','$group_id',NOW())" ;
        $query_run = mysqli_query($connection,$query);
        if($query_run){
            $_SESSION['status']= "出席情報を送信しました！";
            $_SESSION['status_code'] = "success";
            header('location: index.php');
        }else{
            $_SESSION['status']= "送信失敗しました！";
            $_SESSION['status_code'] = "error";
            header('location: index.php');
        }

    }else{
        $_SESSION['status']= "科目記号を入力してください！";
        $_SESSION['status_code'] = "error";
        header('location: index.php');
    } 
}
?>