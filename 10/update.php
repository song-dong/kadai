<?php
session_start();
include("functions.php");
sessChk();

//入力チェック(受信確認処理追加)
if(
  !isset($_POST["b_name"]) || $_POST["b_name"]=="" ||
  !isset($_POST["a_name"]) || $_POST["a_name"]=="" ||
  !isset($_POST["b_url"]) || $_POST["b_url"]==""
){
  exit('ParamError');
}

//1.POSTでParamを取得
$id = $_POST["id"];
$b_name = $_POST["b_name"];
$a_name = $_POST["a_name"];
$b_url = $_POST["b_url"];
$comment = $_POST["comment"];

//FileUpload
if(isset($_FILES['filename']) && $_FILES['filename']['error']==0){
    $upload_file = "./upload/".$_FILES["filename"]["name"];
    if (move_uploaded_file($_FILES["filename"]["tmp_name"],$upload_file)){
        chmod($upload_file,0644);
    }else{
        echo "fileuploadOK....Failed";
    }
}else{
    echo "fileupload失敗";
}


//2.DB接続など
$pdo = db_con();

//3.UPDATE gs_an_table SET ....; で更新(bindValue)
//　基本的にinsert.phpの処理の流れです。
$stmt = $pdo->prepare("UPDATE gs_bm_table SET b_name=:b_name, a_name=:a_name, b_url=:b_url, comment=:comment, img=:img WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':b_name', $b_name, PDO::PARAM_STR);
$stmt->bindValue(':a_name', $a_name, PDO::PARAM_STR);
$stmt->bindValue(':b_url', $b_url, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':img',$upload_file, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  header("Location: select.php");
  exit;
}

?>
