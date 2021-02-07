<?php
include('security.php');?>

<?php
if($_SESSION['usertype'] !== "teacher"){
  header('location:../index.php');
}
?>

<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">ユーザープロファイルを編集する</h6>
  </div>

  <div class="card-body">
  <?php
    

    if(isset($_POST['edit_btn'])){
        $id=$_POST['edit_id'];
        $query= "SELECT * FROM register WHERE id='$id'";
        $query_run=mysqli_query($connection,$query);

        foreach($query_run as $row){
            ?>
            <form action="code.php" method="POST">
              <input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">
              <div class="form-group">
                  <label> 名前 </label>
                  <input type="text" name="edit_username" value="<?php echo $row['username'];?> " class="form-control" placeholder="山田太郎">
              </div>
              <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="edit_email" value="<?php echo $row['email'];?> " class="form-control" placeholder="thsxxxxx@hal.tokyo.jp">
              </div>
              <div class="form-group">
                  <label>パスワード</label>
                  <input type="password" name="edit_password" value="" class="form-control" placeholder="半角英数字８文字以上">
              </div>
              <div class="form-group">
                  <label>グループ</label>
                  <select name="update_group" class="form-control">
                    <option value="A1">A1</option>
                    <option value="A2">A2</option>
                    <option value="A3">A3</option>
                    <option value="B1">B1</option>
                    <option value="B2">B2</option>
                    <option value="B3">B3</option>
                    <option value="N/A">N/A</option>
                  </select>
              </div>
              <div class="form-group">
                  <label>ユーザータイプ</label>
                  <select name="update_usertype" class="form-control">
                    <option value="leader">リーダー</option>
                    <option value="member">メンバー</option>
                    <option value="teacher">教師</option>
                  </select>
              </div>

              <a href="register.php" class="btn btn-danger">キャンセル</a>
              <button type="submit" name="register_update" class="btn btn-primary">更新する</button>
            </form>
            <?php
        }
    }
 ?> 
  



  </div>
  </div>
</div>

</div>




<?php
include('includes/scripts.php');
include('includes/footer.php');
?>