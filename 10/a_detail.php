<?php
session_start();
include("functions.php");
sessChk();

//1.GETでidを取得
$id = $_GET["id"];

//2.DB接続など
$pdo = db_con();

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
    $row = $stmt->fetch();
  }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button><a class="navbar-brand" href="a_select.php">Administration</a></button>
                </div>
            </div>
        </nav>
        <h1>REGISTRATION</h1>
    </header>

    <div class="main">
        <form id="regist" method="post" action="a_update.php">
            <h2>User Registration Form</h2>
            <input type="hidden" name="id" value="<?=$id?>">
            <fieldset>
                <input type="text" placeholder="Name" name="name" value="<?=$row["name"]?>">
            </fieldset>
            <fieldset>
                <input type="text" placeholder="Login ID" name="lid" value="<?=$row["lid"]?>">
            </fieldset>
            <fieldset>
                <input type="text" placeholder="Login Password" name="lpw" value="<?=$row["lpw"]?>">
            </fieldset>
            <fieldset>
                <input type="radio" name="kanri_flg" value="0">　User　　　
                <input type="radio" name="kanri_flg" value="1">　Administrator
            </fieldset>
            <fieldset>
                <input type="radio" name="life_flg" value="0">　Active　　
                <input type="radio" name="life_flg" value="1">　Inactive
            </fieldset>
            <fieldset>
                <input type="submit" value="SUBMIT">
            </fieldset>
        </form>
    </div>


</body>

</html>