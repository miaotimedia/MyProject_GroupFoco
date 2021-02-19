

<?php
$server_name="localhost";
$db_username="root";
$db_password="";
$db_name="adminpanel";

// $server_name="sql208.epizy.com";
// $db_username="epiz_27851455";
// $db_password="6RhrrpE3xMJ";
// $db_name="epiz_27851455_groupfoco";

$connection=mysqli_connect($server_name,$db_username,$db_password,$db_name);
$dbconfig=mysqli_select_db($connection,$db_name);
if($dbconfig){
    //echo"データベースへの接続は成功しました。";
}else{
    echo'
    <div class="container">
        <div class="row">
            <div class="col-md-8 mr-auto ml-auto text-center py-5 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title bg-danger text-white">Database Connection Failed!</h1>
                        <h2 class="card-title">データベースへの接続は失敗しました。</h2>
                        <p class="card-text">データベースへの接続をチェックしてください。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    ';
}

?>

