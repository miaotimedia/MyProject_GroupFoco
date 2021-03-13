</head>
<body class="bg-light">

<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand mr-auto mr-lg-0" href="index.php">Group Foco</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">ホーム<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">伝達事項</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="updates.php">タスク一覧</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="q_and_a.php">Q&Aコーナー</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="summary.php">作品説明</a>
            </li>
        </ul>
        <!-- Notification -->
        <ul class="navbar-nav ml-auto nav-flex-icons">
        <?php
          if($_SESSION['usertype']== "leader"){ 
              echo '<li class="mr-2">
                      <a class="nav-link" data-toggle="modal" data-target="#attendance">
                        <i class="fa fa-calendar-check-o" aria-hidden="true">出席確認</i>
                      </a>
                    </li>';
          }
        ?>
          <li class="nav-item dropdown mr-2">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-envelope"></i>
              <!-- Counter-->
              <span class="badge badge-danger badge-counter"></span>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-list dropdown-menu dropdown-menu-lg-right see_notification" aria-labelledby="messagesDropdown">
              <h6 class="dropdown-header border-bottom text-center bg-light">メッセージセンター</h6>
              <div class="notification_item"></div>
              <a class="dropdown-item text-center border-top small text-gray-500" href="view_notification.php">もっと見る</a>
            </div>
          </li>
      <!-- User Info  -->
          <li class="nav-item avatar dropdown">
            <a class="nav-link active" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <span class="mr-2 d-none d-lg-inline text-gray-600 small">             
                こんにちは、<?php echo $_SESSION['username'];?>！               
              </span>
              <img src="./admin/upload/<?php echo $_SESSION['user_icon'];?> " class="img-profile rounded-circle" width="30" height="30" alt="user icon">
              <i class="fa fa-caret-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary"
              aria-labelledby="navbarDropdownMenuLink-55">
              
              <a class="dropdown-item" href="view_notification.php">通知一覧</a>
              <?php
                if($_SESSION['usertype'] == "teacher"){
                  echo "<a class='dropdown-item' href='admin/index.php'>管理システムへ</a>";
                }else{
                  echo "<a class='dropdown-item' href='user_info.php'>ユーザー情報</a>";
                }
              ?>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                ログアウト
              </a>
            </div>
          </li>
        </ul>
      </div>
    <!-- Collapsible content end-->    
  </div>
</nav>


  <!-- Logout Modal-->

  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">ログアウト</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body"><p>本当にログアウトしますか？</p></div>
        <div class="modal-footer">
        <form action="./admin/logout.php" method="POST"> 
            <button class="btn btn-outline-primary waves-effect" type="button" data-dismiss="modal">キャンセル</button>
            <button type="submit" name="logout_btn" class="btn btn-primary">ログアウト</button>
        </form>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="attendance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">出席確認</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="front_code.php" method="post">
                <input type="hidden" name="group_id" class="form-control" value="<?php echo $group_id; ?>"> 
                <div class="modal-body">
                    <?
                        $query="SELECT username FROM register WHERE group_id='$group_id'";
                        $query_run = mysqli_query($connection, $query);
                    ?>
                    <div class="form-group">
                        <label> 科目記号 </label>
                        <input type="text" name="class" class="form-control">
                    </div>
                    
                    <div class="form-group">
                      <label>曜日</label>
                      <select name="day" class="form-control">
                        <option value="月">月</option>
                        <option value="火">火</option>
                        <option value="水">水</option>
                        <option value="木">木</option>
                        <option value="金">金</option>
                      </select>
                    </div>

                    <div class="form-group">
                      <label>時間帯</label>
                      <select name="time_range" class="form-control">
                        <option value="１限">１限</option>
                        <option value="２限">２限</option>
                        <option value="３限">３限</option>
                        <option value="４限">４限</option>
                        <option value="５限">５限</option>
                      </select>
                    </div>

                    <div class="form-group">
                        <label> 欠席メンバー </label><br>
                        <?
                        if(mysqli_num_rows($query_run) > 0){
                        foreach($query_run as $row){
                        ?>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="att_check[]" value="<?php echo $row['username'];?>">
                        <label class="form-check-label" for="inlineCheckbox1"><?php echo $row['username'];?></label>
                        </div>
                        <? }
                    } ?>
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉める</button>
                <button type="submit" name="attendance" class="btn btn-primary">送信</button>
            </div>
            </form>
        </div>
    </div>
</div>