<?php
include('functions.php');

//入力チェック(受信確認処理追加)
if (
    !isset($_POST['price']) || $_POST['price']==''
) {
    exit('ParamError');
}

//POSTデータ取得
$id     = $_POST['id'];
$lot     = $_POST['lot'];
$time    = $_POST['time'];
$artist  = $_POST['artist'];
$title   = $_POST['title'];
$memo    = $_POST['memo'];
$image   = $_POST['image'];
$price   = $_POST['price'];
//DB接続します(エラー処理追加)
$pdo = db_conn();

//データ登録SQL作成
$sql = 'UPDATE auction2019 SET lot=:a1,time=:a2, artist=
a3, title=:a4 ,image=:a5 ,price=:a6,WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $lot, PDO::PARAM_INT);
$stmt->bindValue(':a2', $time, PDO::PARAM_STR);
$stmt->bindValue(':a3', $artist, PDO::PARAM_STR);
$stmt->bindValue(':a6', $price, PDO::PARAM_INT);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ登録処理後
if ($status==false) {
    errorMsg($stmt);
} else {
    header('Location: main.php');
    exit;
}
