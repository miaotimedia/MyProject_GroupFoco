  <!-- Bootstrap core JavaScript-->
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>


  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>



    <!-- sweet alert  -->
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <?php
  if(isset($_SESSION['status']) && $_SESSION['status']!= ''){ ?>
    <script>

      swal({
        title: "<?php echo $_SESSION['status'];?>",
        //text: "You clicked the button!",
        icon: "<?php echo $_SESSION['status_code'];?>",
        button: "Close",
      });

    </script>
    <?php 
    unset($_SESSION['status']);
  }
  ?>



<script>

// show notification
$(document).ready(function(){
 
    function load_unseen_notification(view = '')
    {
        $.ajax({
            url:"notification_code.php",
            method:"POST",
            data:{view:view},
            dataType:"json",
            success:function(data)
            {
                $('.notification_item').html(data.notification);
                if(data.unseen_notification > 0)
                {
                    $('.badge-counter').html(data.unseen_notification);
                }
            }
        });
    }
    load_unseen_notification();

// send notification
    $('#notification_form').on('submit', function(event){
        event.preventDefault();
        if($('#subject').val() != '' && $('#comment').val() != ''){
            var form_data = $(this).serialize();
            $.ajax({
                url:"notification_code.php",
                method:"POST",
                data:form_data,
                success:function(data)
                {
                    $('#notification_form')[0].reset();
                    load_unseen_notification();
                }
            });
            swal ( "送信しました!" ,"", "success" );
        }else{
            swal ( "タイトルと内容を書いてください！" ,"", "error" );
        }
    });

    $(document).on('click', '.see_notification', function(){
        $('.badge-counter').html('');
        load_unseen_notification('yes');
    });

// auto refresh
    setInterval(function(){ 
    load_unseen_notification();; 
    }, 5000);

});
</script>

 