<?php include('admin/security.php');?>
<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>

<!-- Modal -->
<div class="modal fade" id="Updates" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">新しいタスクを作成</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <form action="front_code.php" method="POST" enctype="multipart/form-data"> 
            <div class="modal-body">

                        <div class="form-group">
                            <label>タイトル</label>
                            <input type="text" class="form-control" name="updates_title" placeholder="Enter Title" required>   
                        </div>

                        <div class="form-group">
                            <label>内容</label>
                            <textarea class="form-control" name="updates_description" rows="5" palceholder="Enter Description" required></textarea>
                        </div>

                        <div class="form-group">
                            <label>ファイル</label>
                            <input type="file" name="updates_file"  id="updates_image" >   
                        </div>  
                        <div class="form-group">
                            <label>提出日</label>
                            <input type="date" class="form-control" name="updates_due" required>   
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
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">戻る</button>
                <button type="submit" name="updates_save" class="btn btn-primary">送信</button>
            </div>
        </form>

    </div>
  </div>
</div>

<main role="main" class="container py-5">
  <div class="d-flex align-items-center p-3 my-3 text-black-50 bg-purple rounded shadow-sm">
    <i class="fa fa-info-circle fa-5x mr-3 " aria-hidden="true"></i>
    <div class="lh-100">
      <h6 class="mb-0 text-black lh-100">タスクを優先度と優先順位を付けて、プロジェクトを効率化しましょう！</h6>
      <small>優先度は、［高い］［中］［低い］や［A］［B］［C］などの指標化できるものです。</small>
      <small class="ml-3">優先度：A＞B＞C</small><br>
      <small>優先順位は、明確な序列です。</small>
      <small class="ml-3">優先順位：1番目＞2番目＞3番目>4番目>5番目</small>
    </div>
 
  </div>

  <?php
    if($_SESSION['usertype']== "leader"){ 
        echo '<button type="button" class="btn btn-primary float-right btn-sm mt-1 mr-3" data-toggle="modal" data-target="#Updates">
        新しいタスクを作成
              </button>';
    }
  ?>



  <div class="my-3 p-3 bg-white rounded shadow-sm"> 
    <h6 class="border-bottom border-gray pb-2 mb-0">タスク</h6>
    
    <?php
    $query ="SELECT * from updates WHERE group_id = '$group_id' ORDER BY id DESC";
    $query_run = mysqli_query($connection,$query);
    
    if(mysqli_num_rows($query_run) > 0){
        foreach($query_run as $row){
    ?>
    
    <div class="media text-muted pt-3">
      <!-- Here shows the priority of the task -->
      <?php
        if($row['priority'] == "A"){
          echo"<span class='bg-danger m-3' style='height: 50px; width:50px;'><h3 class='p-2 text-white'>".$row['priority'].$row['prioritization']."</h3></span>";
        }elseif($row['priority'] == "B"){
          echo"<span class='bg-warning m-3' style='height: 50px; width:50px;'><h3 class='p-2 text-white'>".$row['priority'].$row['prioritization']."</h3></span>";
        }else{
          echo"<span class='bg-success m-3' style='height: 50px; width:50px;'><h3 class='p-2 text-white'>".$row['priority'].$row['prioritization']."</h3></span>";
        }
      ?>
      <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
        <div class="d-flex justify-content-between align-items-center w-100">
          <strong class="text-gray-dark"><?php echo $row['title'];?></strong>
          <form action="updates_more.php" method="POST">
            <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
            <button  type="submit" name="more" class="btn btn-link btn-sm text-primary">詳しく</button>
          </form>
        </div>
        <span class="d-block"><?php echo $row['update_date'];?></span>
        <span class="d-block text-primary">提出日:    <?php echo $row['due_date'];?></span>
      </div>
    </div>

    <?php
        }   
    }else{
        echo"NO data found!";
    }
    ?>


<!--     
    <small class="d-block text-right mt-3">
      <a href="#">View All</a>
    </small> -->
  </div>
</main>

<?php include('includes/scripts.php');?>
<?php include('includes/footer.php');?>

   
