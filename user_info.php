<?php include('admin/security.php');?>
<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>
<?php
$user_id=$_SESSION['user_id'];
$query= "SELECT * FROM register WHERE id='$user_id'";
$query_run=mysqli_query($connection,$query);

if(mysqli_num_rows($query_run) > 0){
    foreach($query_run as $row){
        $username=$row['username'];
        $email=$row['email'];

?>
<main class="m-5">
<div class="modal fade" id="edit_user_info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ユーザー情報を編集する</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="front_code.php" method="POST" enctype="multipart/form-data">
        
        <div class="modal-body">
            <div class="form-group">
                <label>ユーザー名 </label>
                <input type="text" name="username" class="form-control" value="<?php echo $username;?>">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control checking_email" value="<?php echo $email;?>">
            </div>
            <div class="form-group">
                <label>旧パスワード</label>
                <input type="password" name="old_password" class="form-control">
            </div>
            <div class="form-group">
                <label>新しいパスワード</label>
                <input type="password" name="new_password" class="form-control" placeholder="半角英数字８文字以上">
            </div>
            <div class="form-group">
                <label>ユーザーアイコン</label><br>
                <input type="file" name="user_icon"  id="user_icon" >   
            </div>      
        </div>
        <div class="modal-footer">
            <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉める</button>
            <button type="submit" name="edit_userinfo" class="btn btn-primary">保存する</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="py-5 text-center">
    <img class="d-block mx-auto mb-4" src="./admin/upload/<?php echo $_SESSION['user_icon'];?> "  width="100" height="100" alt="user_icon">
    <h2><?php echo $username;?></h2>
    <p class="lead"><?php echo $email;?></p>
    <button  type="submit" class="btn btn-primary" data-toggle="modal" data-target="#edit_user_info"> ユーザー情報を編集する</button>
</div>
<?php
    }
}else{
    echo "NO data found!";
}
?>
<div class="text-left">
<h5>Q&A更新履歴</h5>

<table class="table">
  <thead>
    <tr>
      <th scope="col">タイトル</th>
      <th scope="col">日時</th>
      <th scope="col">コメント数</th>
      <th scope="col">URL</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $post_query= "SELECT * FROM q_and_a WHERE poster_id='$user_id'";
    $post_query_run=mysqli_query($connection,$post_query);
    if(mysqli_num_rows($post_query_run) > 0){
        foreach($post_query_run as $row){
    ?>
    <tr>
      <td><?php echo $row['title'];?></td>
      <td><?php echo $row['post_date'];?></td>
      <td></td>
      <td><a href="q_and_a_more.php?post_id=<?php echo $row['post_id']; ?>">Go</a></td>
    </tr>
    <?php
        }
    }else{
        echo "Q&Aのデータがありません！";
    }
    ?>
  </tbody>
</table>  
</div>

</main>

<?php include('includes/scripts.php');?>
<?php include('includes/footer.php');?>