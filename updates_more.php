<?php include('admin/security.php');?>
<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>



<main role="main" class="container mt-5 pt-5">
  <div class="container">
    <section class="mt-3">
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card mb-4">
                  <div class="card-body">
                  <?php
                    if(isset($_POST['more'])){
                        $id=$_POST['edit_id'];
                        $query= "SELECT * FROM updates WHERE id='$id'";
                        $query_run=mysqli_query($connection,$query);

                        foreach($query_run as $row){
                            ?>
                    <h2><?php echo $row['title'];?> </h2>
                    <small><?php echo $row['update_date'];?></small>
                    <hr>
                    <p class="blog-post-meta">提出日：<?php echo $row['due_date'];?> </p>
                    <p><?php echo $row['description'];?></p>
                    <div class="d-flex mb-4 align-items-start border-bottom">
                      <strong class="mt-2">ファイル：</strong>
                      <a href="download.php?id=<?php echo $row['id'];?>" class="btn btn-link ml-4">
                        <?php echo $row['file'];?>
                      </a>
                    </div>
                    <div class="row">
                      <div class="col-12 px-3">
                        <a href="updates.php" class="btn btn-secondary mx-3 float-right">Back</a>
                        <form action="updates_edit.php" method="post">
                              <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                        <?php
                          if($_SESSION['usertype']== "leader"){ 
                              echo '
                              <button  type="submit" name="edit_btn" class="btn btn-link float-right"> 編集</button>
                              ';
                          }
                        ?>
                        </form>
                      </div>
                    </div>
                </div>
              </div>
          </div>
      </section>
    </div>
<?php
      }
    }else{
      echo "no data";
    }
?> 
</main>


<?php include('includes/footer.php');?>
<?php include('includes/scripts.php');?>
