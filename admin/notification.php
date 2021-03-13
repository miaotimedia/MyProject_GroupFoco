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
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">通知を書く</h6>
        </div>
        <div class="card-body">
            <form action="#" method="post" id="notification_form">
                <div class="form-group">
                    <label>タイトル</label>
                    <input type="text" name="subject" id="subject" class="form-control" require>
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea name="comment" id="comment" class="form-control" rows="5" require></textarea>
                </div>
                <div class="form-group">
                    <input type="submit" name="post_notification" id="post_notification" class="btn btn-primary float-right" value="送信">
                </div>
            </form>
        </div>
    </div>
</div>
          



<?php include('includes/scripts.php'); ?>
<?php include('includes/footer.php');?>