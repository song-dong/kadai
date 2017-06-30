<?php
session_start();
include("functions.php");
sessChk();

//1.GETでidを取得
$id = $_GET["id"];

//2.DB接続など
$pdo = db_con();

//3.SELECT * FROM gs_an_table WHERE id=***; を取得（bindValueを使用！）
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=:id");
$stmt->bindValue(":id",$id,PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  queryError($stmt);
}else{
  $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }
    </style>
    <script src="ckeditor/ckeditor.js"></script>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="select.php">ブックマーク一覧</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="post" action="update.php" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?=$id?>">
        <div class="jumbotron">
            <fieldset>
                <legend>ブックマーク登録</legend>
                <input type="hidden" name="lid" value="<?=$_SESSION["lid"]?>">
                <label>書籍名：<input type="text" name="b_name" value="<?=$row["b_name"]?>"></label><br>
                <label>著者名：<input type="text" name="a_name" value="<?=$row["a_name"]?>"></label><br>
                <label>URL：<textArea name="b_url" rows="1" cols="40"><?=$row["b_url"]?></textArea></label><br>
                <label>コメント：
                    <textArea name="comment" id="editor1" rows="10" cols="80"><?=$row["comment"]?></textArea>
                    <script>
                        CKEDITOR.replace('editor1');
                    </script>
                </label><br>
                <label>添付ファイル：<input type="file" name="filename"></label><br>
                <input type="submit" value="ブックマークに登録">
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->


</body>

</html>
