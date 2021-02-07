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
        <div class="card-header py-3 ">
            <h6 class="font-weight-bold float-left text-primary">通知一覧</h6>
                <form action="code.php" method="post">
                    <button type="submit" name="delete_multiple_data" class="float-right mt-3 btn btn-danger delete_multi_btn_ajax" >
                        選択された通知を削除する
                    </button>
                </form>
        </div>

        <div class="card-body">

            <div class="table-responsive">
            <?php
            $query= "SELECT * FROM notification ORDER BY notification_id DESC";
            $query_run = mysqli_query($connection,$query);
            ?>

            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th></th>
                        <th>タイトル</th>
                        <th>内容</th>
                        <th>時間</th>
                        <th>削除</th>
                    </tr>
                </thead>
                <tbody>

            <?php 
            if(mysqli_num_rows($query_run) > 0){
                while($row = mysqli_fetch_assoc($query_run)){
            ?>
             <tr>
                <td>
                    <input type="checkbox" onclick="toggleCheckbox(this)" value="<?php echo $row['notification_id']; ?>" <?php echo $row['visible']==1 ? "checked" : ""?>>
                </td>
                <td> <?php echo $row['notification_subject']; ?></td>
                <td> <?php echo $row['notification_text']; ?></td>
                <td> <?php echo $row['notification_datetime']; ?></td>
                <td>
                    <form action="notification_code.php" method="post">
                    <input type="hidden" class="delete_id_value" name="delete_id" value="<?php echo $row['notification_id']; ?>">
                    <a href="javascript:void(0)" class="btn btn-danger delete_btn_ajax">削除</a>
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




<?php include('includes/scripts.php'); ?>

<script>
function toggleCheckbox(box){

    var id=$(box).attr("value");
    if($(box).prop("checked") == true){
        var visible = 1;
    }else{
        var visible=0;
    }

    var data = {
        "search_data":1,
        "id": id,
        "visible": visible
    };

    $.ajax({
        type:"post",
        url:"notification_code.php",
        data:data,
        success: function(response){
            //alert("Data Checked");
        }
    });
}

//confirmation for deleting one single data
$(document).ready(function(){
    $('.delete_btn_ajax').click(function(e){
      e.preventDefault();

      var delete_id = $(this).closest("tr").find('.delete_id_value').val();
      //class of the id wanted to be deleted
      
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
            url:"notification_code.php",
            data:{
              "delete_single_notification":1,
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

//confirmation for deleting nultiple data
$(document).ready(function(){
    $('.delete_multi_btn_ajax').click(function(e){
      e.preventDefault();
      
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
            url:"notification_code.php",
            data:{
              "delete_multiple_data":1,
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
<?php include('includes/footer.php');?>
