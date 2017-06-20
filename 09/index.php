<?php
session_start();
include("functions.php");
sessChk();

$pdo = db_con();

$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

$view="";
if($status==false){
  queryError($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($_SESSION["kanri_flg"]=="1"){
        $view = '<a class="navbar-brand" href="a_index.php">[ユーザー登録]</a>'.'<a class="navbar-brand" href="a_select.php">[ユーザー一覧]</a>';
    }
  }
}
?>



<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
<!--    <link rel="stylesheet" href="css/style.css">-->
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }

    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div>
                    <?=$_SESSION["name"]?>さん、こんにちは。
                </div>
                <div class="navbar-header">
                    <a class="navbar-brand" href="register.php">[ブックマーク登録]</a>
                    <a class="navbar-brand" href="select.php">[ブックマーク一覧]</a>
                    <?=$view?>
                </div>
                <button style="position: fixed; top: 10px; right: 10px;"><a href="logout.php">ログアウト</a></button>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->


</body>

</html>
