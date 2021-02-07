<?php include('admin/security.php');?>
<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>

<main role="main" class="container pb-5" style="margin-top: 100px !important;">
<div class="mx-auto card shadow ">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Q&Aを編集する</h6>
  </div>

  <div class="card-body">
  <?php
    

    if(isset($_POST['edit_btn'])){
        $id=$_POST['edit_id'];
        $query= "SELECT * FROM q_and_a WHERE post_id='$id'";
        $query_run=mysqli_query($connection,$query);

        foreach($query_run as $row){
            ?>
            <form action="front_code.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="edit_id" value="<?php echo $row['post_id'];?>">
                <div class="form-group">
                    <label>タイトル</label>
                    <input type="text" name="edit_title" value="<?php echo $row['title'];?> " class="form-control">
                </div>
                <div class="form-group">
                    <label>内容</label>
                    <textarea class="form-control" name="edit_description" rows="8"><?php echo $row['description'];?></textarea> 
                </div>
                <div class="form-group">
                    <label>ファイル</label>
                    <input type="file" name="update_file" id="update_file" >
                </div> 
               
                <button type="submit" name="q_and_a_update" class="btn btn-primary float-right ml-3">更新する</button>
                <a href="q_and_a.php" class="btn btn-secondary float-right">キャンセル</a>
                
            </form>
            <?php
        }
    }
 ?> 
  



  </div>
  </div>
</div>

</main>

<?php include('includes/scripts.php');?>
<?php include('includes/footer.php');?>
