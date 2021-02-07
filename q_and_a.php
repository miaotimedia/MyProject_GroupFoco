<?php include('admin/security.php');?>
<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>

<h1>Q&A</h1>

<div class="modal fade" id="Updates" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">新しい質問をする</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="front_code.php" method="POST" enctype="multipart/form-data"> 
            <div class="modal-body">
                        <div class="form-group">
                            <label>タイトル</label>
                            <input type="text" class="form-control" name="q&a_title" placeholder="Enter Title" required>   
                        </div>

                        <div class="form-group">
                            <label>内容</label>
                            <textarea class="form-control" name="q&a_description" rows="10" palceholder="Enter Description" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>ファイル</label>
                            <input type="file" name="q&a_file"  id="q&a_file" >   
                        </div>  
                        <input type="hidden" name="poster_id" class="form-control" value="<?php echo $_SESSION['user_id']; ?>"> 
                        <input type="hidden" name="group_id" class="form-control" value="<?php echo $group_id; ?>">     
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">戻す</button>
                <button type="submit" name="q&a_save" class="btn btn-primary">確認</button>
            </div>
        </form>

    </div>
  </div>
</div>

<main role="main" class="container pt-5">
<button type="button" class="btn btn-primary float-right btn-sm mt-4 mr-3" data-toggle="modal" data-target="#Updates">
  新しい質問をする
</button>
 
<div class="my-3 p-3 bg-white rounded shadow-sm"> 
<h6 class="border-bottom border-gray pb-2 mb-0">質問一覧</h6>


<?php
    $query ="SELECT * FROM q_and_a JOIN register ON register.id = q_and_a.poster_id WHERE q_and_a.group_id = '$group_id' ORDER BY q_and_a.post_id DESC";
    $query_run = mysqli_query($connection,$query);
    
    if(mysqli_num_rows($query_run) > 0){
        foreach($query_run as $row){
    ?>
    
    <div class="media text-muted pt-3">
      <i class="fa fa-question-circle fa-4x"></i>
      <div class="media-body pb-3 mb-0 ml-3 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark"><?php echo $row['title'];?></strong>   
          <a href="q_and_a_more.php?post_id=<?php echo $row['post_id']?>" class="btn btn-link btn-sm text-primary">詳しく</a></td>
        </div>
        <span class="d-block"><?php echo $row['post_date'];?></span>
        <span class="d-block text-primary">By: <?php echo $row['username']?></span>
      </div>
    </div>

    <?php
        }   
    }else{
        echo"NO data found!";
    }
    ?>

   

<?php include('includes/scripts.php');?>
<?php include('includes/footer.php');?>