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
    <h6 class="m-0 font-weight-bold text-primary">Updatesを編集する</h6>
  </div>

  <div class="card-body">
  <?php
    

    if(isset($_POST['edit_btn'])){
        $id=$_POST['edit_id'];
        $query= "SELECT * FROM updates WHERE id='$id'";
        $query_run=mysqli_query($connection,$query);

        foreach($query_run as $row){
            ?>
            <form action="code.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">
                <div class="form-group">
                  <label>グループ</label>
                  <select name="group_id" class="form-control">
                    <option value="A1">A1</option>
                    <option value="A2">A2</option>
                    <option value="A3">A3</option>
                    <option value="B1">B1</option>
                    <option value="B2">B2</option>
                    <option value="B3">B3</option>
                  </select>
              </div>
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="edit_title" value="<?php echo $row['title'];?> " class="form-control">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="edit_description" rows="3"><?php echo $row['description'];?></textarea> 
                </div>
                <div class="form-group">
                    <label>Upload Image</label>
                    <input type="file" name="update_file" id="update_file" >
                </div>

                <div class="form-group">
                    <label>Due Date</label>
                    <input type="date" class="form-control" name="edit_due" required>   
                </div>  

                

                <a href="updates.php" class="btn btn-danger">キャンセル</a>
                <button type="submit" name="updates_update" class="btn btn-primary">更新する</button>
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