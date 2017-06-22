<?php

//0.外部ファイル読み込み
include("functions.php");

//1.  DB接続します
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  queryError($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<tr>';
    $view .= '<td width=200 align="center">'.$result["b_name"].'</td>';
    $view .= '<td width=150 align="center">'.$result["a_name"].'</td>';
    $view .= '<td width=100 align="center">'.'<a href="n_detail.php?id='.$result["id"].'">';
    $view .= '[詳細]';
    $view .= '</a>'.'</td>';
    $view .= '</tr>';
  }
}
?>


    <!DOCTYPE html>
    <html lang="ja">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ブックマーク一覧</title>
        <!--        <link rel="stylesheet" href="css/style.css">-->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <style>
            div {
                padding: 10px;
                font-size: 16px;
            }

        </style>
    </head>

    <body id="main">
        <!-- Head[Start] -->
        <header>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="login.php">ログインに戻る</a>
                    </div>
                </div>
            </nav>
        </header>
        <!-- Head[End] -->

        <!-- Main[Start] -->
        <div class="container">
            <table class="table table-bordered">
                <thead>
                    <tr align="center">
                        <th>書籍名</th>
                        <th>著者名</th>
                        <th>詳細</th>
                    </tr>
                </thead>
                <tbody>
                    <?=$view?>
                </tbody>
            </table>
        </div>
        <!-- Main[End] -->

    </body>

    </html>
