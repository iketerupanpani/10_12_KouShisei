<?php
include('functions.php');

// 入力チェック
if (
    !isset($_POST['artist']) || $_POST['artist']=='' 
    // ||
    // !isset($_POST['deadline']) || $_POST['deadline']==''
) {
    exit('ParamError');
}

//POSTデータ取得
$lot = $_POST['lot'];
$title = $_POST['title'];
$artist = $_POST['artist'];
$memo = $_POST['memo'];

//DB接続
$pdo = db_conn();

$sql ='INSERT INTO auction2019(id, lot,time,  artist, title,image,memo) VALUES(NULL, :a1,sysdate(),:a2, :a3, :image,:a4)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $lot, PDO::PARAM_INT);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $artist, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $title, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $memo, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':image', $file_name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//データ登録処理後
if ($status==false) {
    errorMsg($stmt);
} else {
    //index.phpへリダイレクト
    header('Location: index.php');
}
