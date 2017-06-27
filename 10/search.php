<?php

$word = '「'.$_POST["search"].'」';
$search = '%'.$_POST["search"].'%';

//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db16;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE b_name LIKE :search OR a_name LIKE :search");
$stmt->bindValue(':search', $search, PDO::PARAM_STR);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<tr>';
    $view .= '<td width=200 align="center">'.$result["b_name"].'</td>';
    $view .= '<td width=150 align="center">'.$result["a_name"].'</td>';
    $view .= '<td width=100 align="center">'.'<a href='.$result["b_url"].'>'.'リンク'.'</a>'.'</td>';
    $view .= '<td width=400>'.$result["comment"].'</td>';
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
<link href="css/bootstrap.min.css" rel="stylesheet">
<!--
<link rel="stylesheet" href="css/range.css">
<link rel="stylesheet" href="css/style.css">
-->
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="select.php">一覧に戻る</a>
      <p><?=$word?>の検索結果</p>
      </div>
      
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <table border="1">
        <tr align="center">
            <th>書籍名</th>
            <th>著者名</th>
            <th>URL</th>
            <th>コメント</th>
        </tr>
        <?=$view?>
    </table>
</div>
<!-- Main[End] -->

</body>
</html>