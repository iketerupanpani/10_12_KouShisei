<?php
//共通で使うものを別ファイルにしておきましょう。

//DB接続関数（PDO）
function db_conn()
{
    $dbn = 'mysql:dbname=gs_f02_db12;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = 'root';
    try {
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        exit('dbError:'.$e->getMessage());
    }
}

//SQL処理エラー
function errorMsg($stmt)
{
    $error = $stmt->errorInfo();
    exit('ErrorQuery:'.$error[2]);
}

function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
// SESSIONチェック＆リジェネレイト
function chk_ssid()
{
   if(!isset($_SESSION['chk_ssid'])||$_SESSION['chk_ssid']!=session_id()){
    // ログイン失敗時の処理（ログイン画面に移動）
        header('Location:main.php');
    }else{
        // ログイン成功時の処理（一覧画面に移動）
        session_regenerate_id(true);
        $_SESSION['chk_ssid']=session_id();
    }
}

//管理フラグ0の場合はログインエラー
function chk_kanri(){
    if(!isset($_SESSION["kanri_flg"]) ||
      $_SESSION["kanri_flg"] ==0){
        echo "管理者権限がありません";
        exit();
    }
}