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

//1. POSTデータ取得
$lid = $_POST["lid"];
$b_name = $_POST["b_name"];
$a_name = $_POST["a_name"];
$b_url = $_POST["b_url"];
$comment = $_POST["comment"];
echo "$lid";

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



//2. DB接続します(エラー処理追加)
$pdo = db_con();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, lid, b_name, a_name, b_url, comment,
indate, img )VALUES(NULL, :lid, :b_name, :a_name, :b_url, :comment, sysdate(), :img)");
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);
$stmt->bindValue(':b_name', $b_name, PDO::PARAM_STR);
$stmt->bindValue(':a_name', $a_name, PDO::PARAM_STR);
$stmt->bindValue(':b_url', $b_url, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':img',$upload_file, PDO::PARAM_STR);
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  queryError($stmt);

}else{
  //５．index.phpへリダイレクト
  header("Location: index.php");
  exit;
}
?>
