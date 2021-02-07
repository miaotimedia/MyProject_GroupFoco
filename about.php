<?php include('admin/security.php');?>
<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>

<main class="container-fluid" style="margin-top: 50px !important;">
<div clss="container py-5  ">
    <div class="row py-5 justify-content-center">
        <div class="col-md-8">
                <?php
                    include('admin/database/dbconfig.php');
                    $query ="SELECT * from about ";
                    $query_run = mysqli_query($connection,$query);
                    
                    if(mysqli_num_rows($query_run) > 0){
                        foreach($query_run as $row){
                            ?>    
                    <div class="card mb-3">
                    <div class="card-body">       
                    <h5 class="card-title my-3"><?php echo $row['title'];?></h5>
                    <h6 class="my-3"><?php echo $row['subtitle'];?></h6>
                    <p class="card-text my-3"> <?php echo$row['description'];?></p>
                    <p></p><a href="<?php echo $row['links'];?>" class="btn btn-link"><?php echo $row['links'];?></a>
                    </div>  
                    </div>      
                    <?php
                        }   
                    }else{
                        echo"NO data found!";
                    }
                ?>  
        </div>


        <!-- <div class="col-md-4">
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Notice</h5>
                    <p class="card-text">This the summary page for HEW 2020.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        <hr>
            <div class="card">
                <img src="..." class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Notice</h5>
                    <p class="card-text">This the summary page for HEW 2020.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div> -->


    </div>
</div>
</main>
<?php include('includes/scripts.php');?>
<?php include('includes/footer.php');?>
