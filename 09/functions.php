<?php
/** 共通で使うものを別ファイルにしておきましょう。*/

//DB接続関数（PDO）
function db_con(){
  $dbname='gs_db16';
  try {
    $pdo = new PDO('mysql:dbname='.$dbname.';charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('DbConnectError:'.$e->getMessage());
  }
  return $pdo;
}

//SQL処理エラー
function queryError($stmt){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

/**
* XSS
* @Param:  $str(string) 表示する文字列
* @Return: (string)     サニタイジングした文字列
*/
function h($str){
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

function sessChk(){
    if(
        !isset($_SESSION["chk_ssid"]) ||
        $_SESSION["chk_ssid"]  != session_id()
    ){
        echo "LOGIN ERROR";
        exit;
    }
}

function admin(){
        $view .= '<td width=100 align="center">'.'<a href="detail.php?id='.$result["id"].'">';
        $view .= '[編集]';
        $view .= '</a>';
        $view .= '<br>';
        $view .= '<a href="delete.php?id='.$result["id"].'">';
        $view .= '[削除]';
        $view .= '</a>'.'</td>';
        $view .= '</tr>';
}

?>
