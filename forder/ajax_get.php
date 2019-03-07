<?php
include('functions.php');

//DB接続
$pdo = db_conn();

//データ表示SQL作成
$sql = 'SELECT * FROM auction2019 ORDER BY id ASC';
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
?>


