<?php
session_start();
include("functions.php");
sessChk();
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
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">TOPに戻る</a>
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
