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
$price = $_POST['price'];

// Fileアップロードチェック
if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] ==0) {
    // ファイルをアップロードしたときの処理
    // ①送信ファイルの情報取得
    $file_name = $_FILES['upfile']['name']; //ファイル名 
    $tmp_path = $_FILES['upfile']['tmp_name']; //tmpフォルダ 
    $file_dir_path = 'upload/'; //アップロード先

    // ②File名の準備
    $extension = pathinfo($file_name, PATHINFO_EXTENSION); 
    $uniq_name = date('YmdHis').md5(session_id()) . "." . $extension;
    $file_name = $file_dir_path.$uniq_name;

    // ③サーバの保存領域に移動&④表示
    if (is_uploaded_file($tmp_path)) {
    if (move_uploaded_file($tmp_path, $file_name)) { 
        chmod($file_name, 0644);
        $sql ='INSERT INTO auction2019(lot, time, artist, title, image, memo,price)
        VALUES(:a0, sysdate(),:a1, :a2, :image, :a3,:a4)';
    } else{exit('Error:アップロードできませんでした');
    }
}else{
    //ファイルをアップしていない時の処理
    //exit('画像が送信されていません')
        $sql='INSERT INTO auction2019(lot, time, artist, title, image, memo,price)
        VALUES(:a0, sysdate(),:a1, :a2, :image, :a3,:a4)';
}}

// DB接続
$pdo = db_conn();

// データ登録SQL作成
// imageカラムとバインド変数を追加
// $sql ='INSERT INTO php02_table(id, task, deadline, comment, image,indate)
// VALUES(NULL, :a1, :a2, :a3, :image,sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a0', $lot, PDO::PARAM_INT);
$stmt->bindValue(':a1', $artist, PDO::PARAM_STR);
$stmt->bindValue(':a2', $title, PDO::PARAM_STR);
$stmt->bindValue(':a3', $memo, PDO::PARAM_STR);
$stmt->bindValue(':a4', $price, PDO::PARAM_INT);
if(isset($file_name)){
$stmt->bindValue(':image', $file_name, PDO::PARAM_STR);
}
// :imageを$file_nameで追加！
$status = $stmt->execute();

//データ登録処理後
if ($status==false) {
    errorMsg($stmt);
} else {
    //index.phpへリダイレクト
    header('Location: main.php');
}
