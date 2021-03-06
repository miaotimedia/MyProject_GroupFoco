<?php include('admin/security.php');?>
<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>

<main role="main" class="container pb-5" style="margin-top: 100px !important;">
<div class="mx-auto card shadow ">
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
            <form action="front_code.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="edit_id" value="<?php echo $row['id'];?>">
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="edit_title" value="<?php echo $row['title'];?> " class="form-control">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="edit_description" rows="3"><?php echo $row['description'];?></textarea> 
                </div>
                <div class="form-group">
                    <label>Upload File</label>
                    <input type="file" name="update_file" id="update_file" >
                </div>

                <div class="form-group">
                    <label>Due Date</label>
                    <input type="date" class="form-control" name="edit_due" required>   
                </div>
                <div class="form-group">
                    <label>優先度</label>
                    <select name="priority" class="form-control">
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>優先順位</label>
                    <select name="prioritization" class="form-control">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select> 
                </div>  
               
                <button type="submit" name="updates_update" class="btn btn-primary float-right ml-3">更新する</button>
                <a href="updates.php" class="btn btn-secondary float-right">キャンセル</a>
                
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
