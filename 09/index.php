<?php
session_start();
include("functions.php");
sessChk();

$pdo = db_con();

$stmt = $pdo->prepare("SELECT * FROM gs_an_table");
$status = $stmt->execute();

$view="";
if($status==false){
  queryError($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    if($_SESSION["kanri_flg"]=="1"){
        $view = '<a class="navbar-brand" href="a_select.php">ユーザー管理</a>';
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
                    <a class="navbar-brand" href="select.php">ブックマーク一覧</a>
                    <?=$view?>
                </div>
                <button style="position: fixed; top: 10px; right: 10px;"><a href="logout.php">ログアウト</a></button>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="post" action="insert.php">
        <div class="jumbotron">
            <fieldset>
                <legend>ブックマーク登録</legend>
                <input type="hidden" name="lid" value="<?=$_SESSION["lid"]?>">
                <label>書籍名：<input type="text" name="b_name"></label><br>
                <label>著者名：<input type="text" name="a_name"></label><br>
                <label>URL：<textArea name="b_url" rows="1" cols="40"></textArea></label><br>
                <label>コメント：<textArea name="comment" rows="4" cols="40"></textArea></label><br>
                <input type="submit" value="ブックマークに追加">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>
