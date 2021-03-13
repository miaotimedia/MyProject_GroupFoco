<?php

$connect= new PDO('mysql:host=localhost;dbname=adminpanel','root','');

$post_id=$_POST['post_id'];

$query="SELECT * FROM comments JOIN register ON comments.comment_sender_id = register.id WHERE comments.parent_comment_id ='0' AND comments.post_id='$post_id' ORDER BY comments.comment_id DESC";
$statement=$connect->prepare($query);
$statement->execute();

$result = $statement->fetchAll();
$output='';
foreach($result as $row){
    $output.='
    <div class="media d-block d-md-flex mt-4 border-bottom pb-4">
    <img src="admin/upload/'.$row['user_icon'].'" class="rounded-circle z-depth-0" style="width:70px; height:70px;" alt="user_icon">
        <div class="media-body text-center text-md-left ml-md-3 ml-0">
            <h5 class="mt-0 font-weight-bold">'.$row["comment_sender_name"].'
                <small>On '.$row["date_time"].'</small>
                <button type="button" class="btn btn-link reply" id="'.$row["comment_id"].'">返信</button>
            </h5>
            '.$row["comment"].'
        </div>
    </div>          
    ';
    $output .= get_reply_comment($connect, $row["comment_id"]);
}

echo $output;
function get_reply_comment($connect, $parent_id = 0, $marginleft = 0)
{
 $query = "
 SELECT * FROM comments JOIN register ON comments.comment_sender_id = register.id WHERE parent_comment_id = '".$parent_id."'
 ";
 $output = '';
 $statement = $connect->prepare($query);
 $statement->execute();
 $result = $statement->fetchAll();
 $count = $statement->rowCount();
 if($parent_id == 0)
 {
  $marginleft = 0;
 }
 else
 {
  $marginleft = $marginleft + 48;
 }
 if($count > 0)
 {
  foreach($result as $row)
  {
   $output .= '
   <div class="media d-block d-md-flex mt-4 border-bottom pb-4" style="margin-left:'.$marginleft.'px">
   <img src="admin/upload/'.$row['user_icon'].'" class="rounded-circle z-depth-0" style="width:70px; height:70px;" alt="user_icon">
       <div class="media-body text-center text-md-left ml-md-3 ml-0">
           <h5 class="mt-0 font-weight-bold">'.$row["comment_sender_name"].'
               <small>On '.$row["date_time"].'</small>
               <button type="button" class="btn btn-link reply" id="'.$row["comment_id"].'">返信</button>
           </h5>
           '.$row["comment"].'
       </div>
   </div>     

   ';
   $output .= get_reply_comment($connect, $row["comment_id"], $marginleft);
  }
 }
 return $output;
}
?>