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


<!-- Modal -->
<div class="modal fade" id="AboutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="code.php" method="POST">
            <div class="modal-body">
                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Title">   
                        </div>

                        <div class="form-group">
                            <label>Sub Title</label>
                            <input type="text" class="form-control" name="subtitle" placeholder="Enter Sub Title">   
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" rows="3" palceholder="Enter Description"></textarea>
                        </div>

                        <div class="form-group">
                            <label>Links</label>
                            <input type="text" class="form-control" name="links" placeholder="Enter Links">   
                        </div>       
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="about_save" class="btn btn-primary">Save</button>
            </div>
        </form>

    </div>
  </div>
</div>




<div class="container-fluid">

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">伝達事項</h5>
                <button type="button" class="btn btn-link btn-outline-primary  float-right" style="margin-top: -25px;" data-toggle="modal" data-target="#AboutModal">
                    新しい伝達事項を作成する
                </button>
            
        </div>

        <div class="card-body">
            <div class="table-responsive">
            <?php
                $connection= mysqli_connect("localhost","root","","adminpanel");
                $query="SELECT * FROM about";
                $query_run= mysqli_query($connection,$query);

            ?>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>タイトル</th>
                                <th>サブタイトル</th>
                                <th>内容</th>
                                <th>URL</th>
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
                                <td> <?php echo $row['title']; ?></td>
                                <td> <?php echo $row['subtitle']; ?></td>
                                <td> <?php echo $row['description']; ?></td>
                                <td> <?php echo $row['links']; ?></td>
                                <td>
                                    <form action="about_edit.php" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                        <button  type="submit" name="edit_btn" class="btn btn-success"> 編集</button>
                                    </form>
                                </td>
                                <td>
                                    <form action="code.php" method="post">
                                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="about_delete" class="btn btn-danger"> 削除</button>
                                    </form>
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
        </div>
    </div>

</div>




<?php
include('includes/scripts.php');
include('includes/footer.php');
?>