<?php include('admin/security.php');?>
<?php include('includes/header.php');?>
<?php include('includes/navbar.php');?>

<div role="main" class="container mt-5 pt-5">
    <div class="container">
        <section class="mt-3">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <?php
                            if(isset($_GET['post_id'])){
                                $post_id=$_GET['post_id'];
                                $query= "SELECT * FROM q_and_a JOIN register ON register.id = q_and_a.poster_id WHERE q_and_a.post_id='$post_id'";
                                $query_run=mysqli_query($connection,$query);
                        
                                foreach($query_run as $row){
                                    ?>
                         
                            <h5><?php echo $row['title'];?></h5>
                            <p>by <?php echo $row['username'];?>   <?php echo $row['post_date'];?></p>

                            <hr>
                            <p><?php echo $row['description'];?> </p>
                            <div class="d-flex mb-4 align-items-start border-bottom">
                                <strong class="mt-2">ファイル：</strong>
                                <a href="download.php?id=<?php echo $row['post_id'];?>" class="btn btn-link ml-4">
                                    <?php echo $row['file'];?>
                                </a>
                            </div>
                            <div class="row">
                                <div class="col-12 px-3">
                                    <a href="q_and_a.php" class="btn btn-secondary mx-3 float-right">戻る</a>
                                    <form action="q_and_a_edit.php" method="post">
                                        <input type="hidden" name="edit_id" value="<?php echo $row['post_id']; ?>">
                                    <?php
                                    if($_SESSION['user_id']== $row['poster_id']){ 
                                        echo '
                                        <button  type="submit" name="edit_btn" class="btn btn-link float-right"> 編集</button>
                                        ';
                                    }
                                    ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php 
                                }
                            }
                    ?>
                    </div>

                     <!--Reply-->
                     <div class="card mb-3 wow fadeIn">
                        <div class="card-header font-weight-bold">コメントを入力する</div>
                        <div class="card-body">

                            <form method="POST" id="comment_form">

                                <!--Write Comment -->
                                <div class="form-group">
                                    <textarea class="form-control" id="comment_content" name="comment_content" rows="5"></textarea>
                                </div>

                                <!-- Name -->
                                <input type="hidden" name="commenter_id" id="commenter_id" class="form-control" value="<?php echo $_SESSION['user_id']; ?>">
                                <input type="hidden" name="commenter_name" id="commenter_name" class="form-control" value="<?php echo $_SESSION['username']; ?>">
                                <input type="hidden" name="post_id" id="post_id" class="form-control" value="<?php echo $post_id; ?>">

                                <div class="text-right mt-4">
                                    <input type="hidden" name="comment_id" id="comment_id" value="0" />
                                    <input  class="btn btn-primary" name="submit" type="submit" id="submit" value="送信">
                                </div>
                            </form>
                            <!-- Default form reply -->
                            <span id="comment_message"></span>
                        </div>
                    </div>

                    <!--Comments-->
                    <div class="card card-comments mb-3 wow fadeIn">
                        <div class="card-header font-weight-bold">コメント</div>
                        <div class="card-body" id="display_comment"></div>
                    </div>
                    <!--/.Comments-->
                </div>
                <div class="col-md-4 mb-4">
                    <div class="sticky">
                        <section>
                          <div id="dynamic-content"></div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){

    $('#comment_form').on('submit', function(event){
        event.preventDefault();
        var form_data=$(this).serialize();
        $.ajax({
            url:"add_comment.php",
            method:"POST",
            data:form_data,
            dataType:"JSON",
            success:function(data)
            {
                if(data.error != '')
                {
                $('#comment_form')[0].reset();
                $('#comment_message').html(data.error);
                $('#comment_id').val('0');
                load_comment();
                }
            }
        })
    });

    load_comment();

    function load_comment(){
        $.ajax({
            url:"fetch_comment.php",
            method:"POST",
            data:{
                'post_id':$('#post_id').val()
                },
            success:function(data)
            {
                $('#display_comment').html(data);
            }
        })
    }

    $(document).on('click', '.reply', function(){
        var comment_id = $(this).attr("id");
        $('#comment_id').val(comment_id);
        $('#comment_content').focus();
    });

});



</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<?php include('includes/scripts.php');?>
<?php include('includes/footer.php');?>






