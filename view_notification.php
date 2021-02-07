<?php include('admin/security.php');?>
<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>

<main class="mt-5 pt-5">
    <div class="container-fluid">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 ">
                <h4 class="font-weight-bold float-left text-primary mt-4">通知一覧</h4>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                <?php
                $query= "SELECT * FROM notification JOIN register ON notification.user_id = register.id ORDER BY notification.notification_id DESC";
                $query_run = mysqli_query($connection,$query);
                ?>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>タイトル</th>
                            <th>送信先</th>
                            <th>内容</th>
                            <th>時間</th>
                        </tr>
                    </thead>
                    <tbody>

                <?php 
                if(mysqli_num_rows($query_run) > 0){
                    while($row = mysqli_fetch_assoc($query_run)){
                ?>
                <tr>
                    <td> <?php echo $row['notification_subject']; ?></td>
                    <td> <?php echo $row['username']; ?></td>
                    <td> <?php echo $row['notification_text']; ?></td>
                    <td> <?php echo $row['notification_datetime']; ?></td>
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
</main>



<?php include('includes/scripts.php');?>
<?php include('includes/footer.php');?>
