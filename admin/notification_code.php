<?php
include('security.php');

if(isset($_POST["view"])){

    $current_user=$_SESSION['user_id'];
    //record the users who have already read the notification
    if($_POST["view"] != '')
    {
        $get_notif_id = "SELECT * FROM notification WHERE notification_id NOT IN (SELECT notification_id FROM seen_notification WHERE user_id='$current_user')";
        $get_notif_id_run= mysqli_query($connection, $get_notif_id);
        if(mysqli_num_rows($get_notif_id_run) > 0){
           foreach($get_notif_id_run as $row){
                $notif_id=$row['notification_id'];
                $seen_query = "INSERT INTO seen_notification (notification_id, user_id) VALUES ('$notif_id','$current_user')";
                mysqli_query($connection, $seen_query);
            }
        }
    }
    //select unread notification
    $query = "SELECT notification.notification_id,notification.notification_subject, notification.notification_text, notification.notification_datetime, register.username FROM notification 
    INNER JOIN register ON notification.user_id= register.id
    WHERE notification.notification_id NOT IN (SELECT notification_id FROM seen_notification WHERE user_id='$current_user')
    ORDER BY notification.notification_id DESC";
    $query_run = mysqli_query($connection, $query);
    $output="";
    $count= mysqli_num_rows($query_run);

    if($count > 0){
        while($row = mysqli_fetch_array($query_run)){
            $output .="
                <a class='dropdown-item d-flex align-items-center border-bottom' href='view_notification.php'>
                    <div class='font-weight-bold'>
                        <h6>".$row["notification_subject"]."</h6>
                        <div class='text-truncate'>".$row["notification_text"]."</div>
                        <div class='small text-gray-500'>".$row["username"]." ".$row["notification_datetime"]."</div>
                    </div>
                </a>";
        }
    }else{
        $output .="
        <a class='dropdown-item d-flex align-items-center mt-2' href='#'>
            <h6>新しい通知があるません。</h6>
        </a>
        ";
    }

    $data = array(
        'notification'   => $output,
        'unseen_notification' => $count
    );
    echo json_encode($data);
}

//Insert new notification
if(isset($_POST["subject"])){
    $subject = mysqli_real_escape_string($connection, $_POST["subject"]);
    $comment = mysqli_real_escape_string($connection, $_POST["comment"]);
    $current_user=$_SESSION['user_id'];
    
    $query = "INSERT INTO notification (notification_subject, notification_text, notification_datetime,user_id,visible)
    VALUES ('$subject', '$comment', NOW(),'$current_user',default)";
    $query_run=mysqli_query($connection, $query);
 
}

//Delete notification
if(isset($_POST['delete_single_notification'])){
    $id=$_POST['delete_id'];
    $query="DELETE FROM notification WHERE notification_id='$id'";
    $query_run = mysqli_query($connection, $query);

    if($query_run){
        $delete_status="DELETE FROM seen_notification WHERE notification_id='$id'";
        mysqli_query($connection, $delete_status);
        $_SESSION['status']="通知をを削除しました。";
        $_SESSION['status_code'] = "success";
        header('location:view_notification.php');
    }else{
        $_SESSION['status']="通知の削除を失敗しました。";
        $_SESSION['status_code'] = "error";
        header('location:view_notification.php');
    }
}

if(isset($_POST['search_data'])){
    $id = $_POST['id'];
    $visible = $_POST['visible'];

    $query = "UPDATE notification SET visible = '$visible' WHERE notification_id='$id' ";
    $query_run = mysqli_query($connection,$query);
}

if(isset($_POST['delete_multiple_data'])){
    $vid = "1";
    $get_id="SELECT * FROM notification WHERE visible='$vid'";
    $get_id_run=mysqli_query($connection,$get_id);
    if(mysqli_num_rows($get_id_run) > 0){
        foreach($get_id_run as $row){
             $notif_id=$row['notification_id'];
             $delete_query = "DELETE FROM seen_notification WHERE notification_id='$notif_id' ";
             mysqli_query($connection, $delete_query );
         }
     }

    $query = "DELETE FROM notification WHERE visible='$vid' ";
    $query_run = mysqli_query($connection,$query);

    if($query_run){
        $_SESSION["status"] = "通知をを削除しました。";
        $_SESSION['status_code'] = "success";
        header("location: view_notification.php");
    }else{
        $_SESSION["status"] = "通知の削除を失敗しました。";
        $_SESSION['status_code'] = "error";
        header("location: view_notification.php");
    }
}
?>