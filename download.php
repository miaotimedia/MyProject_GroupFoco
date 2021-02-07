<?php include('admin/security.php');

if(isset($_GET['id'])){
    $id=$_GET['id'];
    $query="SELECT * FROM updates WHERE id='$id'";
    $query_run=mysqli_query($connection,$query);

    if($query_run){
        foreach($query_run as $row){
            $filepath="admin/upload/".$row['file'];
        }
    
        if(file_exists($filepath)){	
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Transfer-Encoding: binary');
            header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            ob_clean();
            flush(); 
	        readfile($filepath);	 
		    exit;
            
        }

    }else{
        $_SESSION['status']="download failed!";
        $_SESSION['status_code'] = "error";
        header('location:updates.php');
    }
    

}

if(isset($_GET['post_id'])){
    $post_id=$_GET['post_id'];
    $query="SELECT * FROM q_and_a WHERE post_id='$post_id'";
    $query_run=mysqli_query($connection,$query);

    if($query_run){
        foreach($query_run as $row){
            $post_filepath="admin/upload/".$row['file'];
        }
    
        if(file_exists($post_filepath)){	
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Transfer-Encoding: binary');
            header('Content-Disposition: attachment; filename="'.basename($post_filepath).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($post_filepath));
            ob_clean();
            flush(); 
	        readfile($post_filepath);	 
		    exit;
            
        }

    }else{
        $_SESSION['status']="download failed!";
        $_SESSION['status_code'] = "error";
        $url="q_and_a_more.php?post_id=".$post_id.".php";
        header("Location: $url");
    }
    

}
?>