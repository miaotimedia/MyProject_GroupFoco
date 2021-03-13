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

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Aboutを編集する</h6>
  </div>

  <div class="card-body">
  <?php
    

    if(isset($_POST['edit_btn'])){
        $id=$_POST['edit_id'];
        $query= "SELECT * FROM about WHERE id='$id'";
        $query_run=mysqli_query($connection,$query);

        foreach($query_run as $row){
            ?>
            <form action="code.php" method="POST">
                <input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">
                <div class="form-group">
                    <label> Title </label>
                    <input type="text" name="edit_title" value="<?php echo $row['title'];?> " class="form-control">
                </div>
                <div class="form-group">
                    <label>Sub Title</label>
                    <input type="text" name="edit_subtitle" value="<?php echo $row['subtitle'];?> " class="form-control">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="edit_description" rows="3"><?php echo $row['description'];?></textarea> 
                </div>

                <a href="about.php" class="btn btn-danger">キャンセル</a>
                <button type="submit" name="about_update" class="btn btn-primary">更新する</button>
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