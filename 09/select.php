<?php
session_start();

//0.外部ファイル読み込み
include("functions.php");
sessChk();

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
    $view .= '<td width=100 align="center">'.'<a href='.$result["b_url"].'>'.'リンク'.'</a>'.'</td>';
    $view .= '<td width=400>'.$result["comment"].'</td>';
    if($_SESSION["kanri_flg"]=="1"){
        $view .= '<td width=100 align="center">'.'<a href="detail.php?id='.$result["id"].'">';
        $view .= '[編集]';
        $view .= '</a>';
        $view .= '<br>';
        $view .= '<a href="delete.php?id='.$result["id"].'">';
        $view .= '[削除]';
        $view .= '</a>'.'</td>';
        $view .= '</tr>';
    }else if($_SESSION["lid"]==$result["lid"]){
        $view .= '<td width=100 align="center">'.'<a href="detail.php?id='.$result["id"].'">';
        $view .= '[編集]';
        $view .= '</a>';
        $view .= '<br>';
        $view .= '<a href="delete.php?id='.$result["id"].'">';
        $view .= '[削除]';
        $view .= '</a>'.'</td>';
        $view .= '</tr>';
    }
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
                        <a class="navbar-brand" href="index.php">TOPに戻る</a>
                        <form method="post" action="search.php">
                            <input type="text" name="search">
                            <a href="search.php"><button id="search_btn">検索</button></a>
                        </form>
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
                    <th>URL</th>
                    <th>コメント</th>
                    <th>編集・削除</th>
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