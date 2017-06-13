<?php
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=gs_db16;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('Disable to connect to database.'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
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
    $view .= '<td>'.$result["id"].'</td>';
    $view .= '<td>'.$result["name"].'</td>';
    $view .= '<td>'.$result["lid"].'</td>';
    $view .= '<td>'.$result["lpw"].'</td>';
    $view .= '<td>'.$result["kanri_flg"].'</td>';
    $view .= '<td>'.$result["life_flg"].'</td>';
    $view .= '<td>'.'<button><a href="detail.php?id='.$result["id"].'">';
    $view .= 'Update';
    $view .= '</a></button>';
//    $view .= '<br>';
    $view .= '<button><a href="delete.php?id='.$result["id"].'">';
    $view .= 'Delete';
    $view .= '</a></button>'.'</td>';
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
        <title>Administration</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body id="main">
        <!-- Head[Start] -->
        <header>
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button><a class="navbar-brand" href="index.html">Register more</a></button>
                    </div>
                </div>
            </nav>
            <h1>ADMINISTRATION</h1>
        </header>
        <!-- Head[End] -->

        <!-- Main[Start] -->
        <div class="container">
            <table class="table table-bordered">
               <thead>
                <tr>
                    <th>No.</th>
                    <th>User Name</th>
                    <th>Login ID</th>
                    <th>Login Password</th>
                    <th>Attribute</th>
                    <th>Status</th>
                    <th>Administration</th>
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
