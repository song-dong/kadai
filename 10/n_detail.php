<?php
include("functions.php");

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
        <title>データ詳細</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
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
                    <div class="navbar-header">
                        <a class="navbar-brand" href="n_select.php">ブックマーク一覧に戻る</a>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Head[End] -->

        <!-- Main[Start] -->
        <div class="jumbotron">
            <fieldset>
                <legend>ブックマーク詳細</legend>
                <label><img src="<?=$row["img"]?>" width=100></label><br>
                <label>書籍名：<input type="text" name="b_name" value="<?=$row["b_name"]?>" readonly="readonly"></label><br>
                <label>著者名：<input type="text" name="a_name" value="<?=$row["a_name"]?>" readonly="readonly"></label><br>
                <label>URL：<a href="<?=$row["b_url"]?>">Amazonリンク</a></label><br>
                <label>コメント：<textArea name="comment" rows="4" cols="40" readonly="readonly"><?=$row["comment"]?></textArea></label><br>
            </fieldset>
        </div>
        <!-- Main[End] -->


    </body>

    </html>
