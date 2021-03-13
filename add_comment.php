
<?php
$connect= new PDO('mysql:host=localhost;dbname=adminpanel','root','');
$error='';
$comment_content='';
$commenter_id=$_POST["commenter_id"];
$commenter_name=$_POST["commenter_name"];
$post_id=$_POST["post_id"];


if(empty($_POST['comment_content'])){
    $error .= '<p class="text-danger">Comment is required</p>';
}else{
    $comment_content=$_POST["comment_content"];
}


if($error==''){
    $query="INSERT INTO comments (parent_comment_id, comment, comment_sender_id,comment_sender_name,post_id) VALUES (:parent_comment_id, :comment, :comment_sender_id, :comment_sender_name,:post_id)";
    $statement = $connect -> prepare($query);
    $statement->execute(
        array(
            ':parent_comment_id' => $_POST["comment_id"],
            ':comment' => $comment_content,
            ':comment_sender_id' => $commenter_id,
            ':comment_sender_name' => $commenter_name,
            ':post_id'=> $post_id 
        )
    );
    $error = '<label class="text-success">投稿にコメントをしました！</label>';
}


$data = array(
    'error'  => $error
 );
echo json_encode($data);



?>