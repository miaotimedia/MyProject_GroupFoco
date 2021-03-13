<?php
include('security.php');?>

<?php
if($_SESSION['usertype']!== "teacher"){
  header('location:../index.php');
}

if(isset($_POST['search_submit'])){
  $username = $_POST['search'];
}
?>

<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">新規登録</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> 名前 </label>
                <input type="text" name="username" class="form-control" placeholder="山田太郎">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control checking_email" placeholder="thsxxxxx@hal.tokyo.jp">
                <small class="error_mail" style="color: red;"></small>
            </div>
            <div class="form-group">
                <label>グループ</label>
                <select name="group_id" class="form-control">
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
                <label>パスワード</label>
                <input type="password" name="password" class="form-control" placeholder="半角英数字８文字以上">
            </div>
            <div class="form-group">
                <label>パスワード確認</label>
                <input type="password" name="confirmpassword" class="form-control" placeholder="もう一回入力して下さい">
            </div>
            <div class="form-group">
                <label>ユーザータイプ</label>
                <select name="usertype" class="form-control">
                  <option value="leader">リーダー</option>
                  <option value="member">メンバー</option>
                  <option value="teacher">教師</option>
                </select>
            </div>
            
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉める</button>
            <button type="submit" name="register_save" class="btn btn-primary">保存する</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->

  <div class="card-body">
    <div class="table-responsive">
    <?php
      $query="SELECT * FROM register WHERE username like '%$username%'";
      $query_run= mysqli_query($connection,$query);
    ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ユーザーID</th>
            <th>名前</th>
            <th>Email</th>
            <th>グループ</th>
            <th>ユーザータイプ</th>
            <th>編集</th>
            <th>削除</th>
          </tr>
        </thead>
        <tbody>
        <?php
          if(mysqli_num_rows($query_run)>0){
            while($row= mysqli_fetch_assoc($query_run)){
              ?>
          <tr>
            <td> <?php echo $row['id']; ?></td>
            <td> <?php echo $row['username']; ?></td>
            <td> <?php echo $row['email']; ?></td>
            <td> <?php echo $row['group_id']; ?></td>
            <td> <?php echo $row['usertype']; ?></td>
            <td>
                <form action="register_edit.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> 編集</button>
                </form>
            </td>
            <td>  
                  <input type="hidden" class="delete_id_value" name="delete_id" value="<?php echo $row['id']; ?>">
                  <a href="javascript:void(0)" class="btn btn-danger delete_btn_ajax">削除</a>
            </td>
          </tr>
          <?php
            }
          }else{
            echo"データがありません。";
          }
          ?>
         
        
        </tbody>
      </table>

    </div>
    <a href="register.php" class="btn btn-secondary mx-3 float-right">戻る</a>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
?>


<script>

  $(document).ready(function(){
    $('.delete_btn_ajax').click(function(e){
      e.preventDefault();

      var delete_id = $(this).closest("tr").find('.delete_id_value').val();
      //alert(delete_id);
      
      swal({
        title: "本当に削除しますか?",
        text: "削除したら, データの復元ができません!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          $.ajax({
            type:"POST",
            url:"code.php",
            data:{
              "register_delete":1,
              "delete_id":delete_id,
            },
            success:function(response){  }
          });

          swal("削除しました！", {
            icon: "success",
          }).then ((result)=>{
            location.reload();
          });
        }else{
          swal("削除しませんでした！", {
            icon: "error",
          });
        } 
      });
    
    });

  });

</script>

<?php
include('includes/footer.php');
//<button type="submit" name="register_delete" class="btn btn-danger delete_btn"> 削除</button>
?>