<?php
include('functions.php');

// 入力チェック
if (
    !isset($_POST['id']) || $_POST['id']=='' 
    // ||
    // !isset($_POST['deadline']) || $_POST['deadline']==''
) {
    exit('ParamError');
}

//POSTデータ取得
$lot = $_POST['id'];
$title = $_POST['title'];
$artist = $_POST['artist'];
$price = $_POST['price'];
//DB接続
$pdo = db_conn();

$sql ='INSERT INTO auction2019(id, time, artist, title, image,memo,price) 
VALUES(NULL,sysdate(), :a1, :a2, image,:a3,;a4)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':a1', $artist, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a2', $title, PDO::PARAM_STR);   //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a3', $memo, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':a4', $price, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();

//データ表示SQL作成
$sql = 'SELECT * FROM aution2019 ORDER BY id ASC';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//データ表示 JSONの形にする
if ($status==false) {
    errorMsg($stmt);
} else {
    $res=[];
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $res[]=$result;
    }
    echo json_encode($res);
}
//データ登録後の処理
if($status==false){
    errorMsg($stmt);
}else{
    //index.phpへリダイレクト
    header('Location: main.php');
}
?>
