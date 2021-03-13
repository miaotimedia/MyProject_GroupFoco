<?php include('admin/security.php');?>
<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>

<main role="main" class="container pt-5">
    <h5 class="mb-3">伝達事項</h5>
    <div class="accordion" id="accordionExample">
        <?php
            include('admin/database/dbconfig.php');
            $query ="SELECT * from about ORDER BY id DESC ";
            $query_run = mysqli_query($connection,$query);
            
            if(mysqli_num_rows($query_run) > 0){
                foreach($query_run as $row){
        ?>    
        <div class="card">
            <div class="card-header" id="heading<?php echo $row['id'];?>">
            <span class="badge badge-danger float-right">Up</span>
                <h2 class="mb-0 float-left">
                    <button class="btn btn-link btn-block text-left text-dark" type="button" data-toggle="collapse" data-target="#collapse<?php echo $row['id'];?>" aria-expanded="false" aria-controls="collapse<?php echo $row['id'];?>">
                    <?php echo $row['title'];?>
                    <small class="ml-3"><?php echo $row['datetime']; ?></small>
                    </button>
                    
                </h2>
            </div>

            <div id="collapse<?php echo $row['id'];?>" class="collapse" aria-labelledby="heading<?php echo $row['id'];?>" data-parent="#accordionExample">
            <div class="card-body">
                <h5 class="card-title my-3"><?php echo $row['title'];?></h5>
                <h6 class="my-3"><?php echo $row['subtitle'];?></h6>
                <small><?php echo $row['datetime']; ?></small>      
                <p class="card-text my-3"> <?php echo nl2br($row['description']);?></p>
            </div>
            </div>
        </div>
        <?php
            }   
        }else{
            echo"データがありません！";
        }
        ?>
        
    </div>
</main>
<?php include('includes/scripts.php');?>
<?php include('includes/footer.php');?>
