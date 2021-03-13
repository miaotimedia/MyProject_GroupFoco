   <!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
  <div class="sidebar-brand-icon" style="margin-left: -30px;">
    <i class="fa fa-graduation-cap" aria-hidden="true"></i>  
  </div>
  <div class="sidebar-brand-text ml-2">
    <sub>Group Foco</sub><br>
    <sub>管理システム</sub>
  </div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="index.php">
    <i class="fa fa-tachometer"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  ユーザーと通知管理
</div>

<!-- Nav Item - Pages Collapse Menu -->

<li class="nav-item">
  <a class="nav-link" href="register.php">
    <i class="fa fa-user" aria-hidden="true"></i>
    <span>ユーザープロファイル</span></a>
</li>


<li class="nav-item">
  <a class="nav-link" href="view_notification.php">
    <i class="fa fa-inbox"></i>
    <span>通知一覧</span>
  </a>
</li>

<li class="nav-item">
  <a class="nav-link" href="notification.php">
    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
    <span>通知を書く</span>
  </a>
</li>



<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  ページ管理
</div>

<li class="nav-item">
  <a class="nav-link" href="./attendance.php">
    <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
    <span>出席情報</span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="./about.php">
    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
    <span>伝達事項</span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="./updates.php">
    <i class="fa fa-tasks" aria-hidden="true"></i>
    <span>タスク一覧</span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="./q_and_a.php">
    <i class="fa fa-quora" aria-hidden="true"></i>
    <span>Q＆A一覧</span></a>
</li>

<li class="nav-item">
  <a class="nav-link" href="./comments.php">
    <i class="fa fa-commenting-o" aria-hidden="true"></i>
    <span>コメント一覧</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<!-- <div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"><i class="fa fa-angle-up"></i></button>
</div> -->

</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-envelope fa-fw"></i>
                <!-- Counter-->
                <span class="badge badge-danger badge-counter"></span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in see_notification" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  メッセージセンター
                </h6>
                <div class="notification_item"></div>
                <a class="dropdown-item text-center small text-gray-500" href="view_notification.php">もっと見る</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-5 d-none d-lg-inline text-gray-600 small"> 
               <?php echo $_SESSION['username'];?>
                </span>
                <img class="img-profile rounded-circle" src="./upload/<?php echo $_SESSION['user_icon'];?>">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item border-bottom" href="../index.php">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  学生システムへ
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  ログアウト
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fa fa-angle-up"></i>
  </a>

  
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
        <form action="logout.php" method="POST"> 
            <button class="btn btn-secondary" type="button" data-dismiss="modal">キャンセル</button>
            <button type="submit" name="logout_btn" class="btn btn-primary">ログアウト</button>
        </form>
        </div>
        
      </div>
    </div>
  </div>