</head>
<body class="bg-light">

<!--Navbar-->
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
  <a class="navbar-brand mr-auto mr-lg-0" href="index.php">Group Foco</a>
  <button class="navbar-toggler p-0 border-0" type="button" data-toggle="offcanvas">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="navbar-collapse offcanvas-collapse ml-4" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
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
    </ul>

   <!-- Nitification -->
    <ul class="navbar-nav ml-auto nav-flex-icons">
      <li class="nav-item dropdown">
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
          <a class="dropdown-item" href="user_info.php">ユーザー情報</a>
          <a class="dropdown-item" href="view_notification.php">通知一覧</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
            ログアウト
          </a>
        </div>
      </li>
    </ul>
  </div>
  <!-- Collapsible content -->
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

 
<!--/.Navbar-->
