<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "db.php";
include 'config.php';
//각 변수에 free_board_write.php에서 title, content, userid 저장
$title = $_POST['title'];
$content = $_POST['content'];
$user = $_SESSION['name'];

$error = $_FILES['file']['error'];
$tmpfile = $_FILES['file']['tmp_name'];
$filename = $_FILES['file']['name'];
$folder = "file/upload/".$filename;

// 파일 최대 용량을 초과시 에러 
if( $error != UPLOAD_ERR_OK ){
	switch( $error ) {
    		case UPLOAD_ERR_INI_SIZE:
        	case UPLOAD_ERR_FORM_SIZE:
        		echo "<script>alert('파일이 너무 큽니다.');";
            		echo "window.history.back()</script>";
            		exit;
	}
}

move_uploaded_file($tmpfile, $folder);


if(isset($_POST['lockpost'])){
	$lo_post = '1';
}else{
	$lo_post = '0';
}


if($title && $content){
    $sql = mc("INSERT INTO qna_board(title,content,name,file,lock_post) VALUES('$title', '$content', '$user', '$filename', '$lo_post')"); 
    echo "<script>
    alert('글쓰기 완료되었습니다.');
    location.href='qna.php';</script>";
}else{
    echo "<script>
    alert('제목과 내용을 확인해주세요.');
    history.back();</script>";
}
?>