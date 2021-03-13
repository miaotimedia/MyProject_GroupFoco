<?php
session_start();
include('includes/header.php'); 
?>




<div class="container">

<div class="row justify-content-center">

  <div class="col-xl-6 col-lg-6 col-md-6">

    <div class="mt-3 img-fluid text-center">
        <img src="./images/icon.png" alt="icon">
    </div>
    <div class="text-center">
        <h1 class="text-dark">Group Foco</h1>
        <h5 class="text-dark">学生プロジェクト管理システム</h5>
        <small class="text-dark">Student Project Management System</small>
    </div>

    <div class="card o-hidden border-0 shadow-lg my-4">
      <div class="card-body p-0">
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">ロクイン</h1>
                
                <?php

                    
                ?>
              </div>

                <form class="user" action="logincode.php" method="POST">

                    <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-user" placeholder="メールアドレス">
                    </div>
                    <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="パスワード">
                    </div>
            
                    <button type="submit" name="login_btn" class="btn btn-primary btn-user btn-block"> Login </button>
                    <hr>
                </form>


            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>


<?php
include('includes/scripts.php'); 

?>