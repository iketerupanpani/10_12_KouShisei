<?php
// セッションのスタート
session_start();

//0.外部ファイル読み込み
include('functions.php');

// ログイン状態のチェック
chk_ssid();

//1.  DB接続します
$pdo = db_conn();

//２．データ登録SQL作成
$sql = 'SELECT * FROM auction2019';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//３．データ表示
$view='';
if ($status==false) {
    errorMsg($stmt);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .='<tr>';
        $view .='<td>';
        // $view .= '<li class="list-group-item">';
        $view .= $result['lot'];
        $view .='</td>';
        $view .='<td>';
        $view .='<img src="'.$result['image'].'" alt="" height="200" >';
        $view .='</td>';
        $view .='<td>';
        $view .= $result['title'];
        $view .='</td>';
        $view .='<td>';
        $view .= $result['artist'];
        $view .='</td>';
        $view .='<td>';
        $view .= '<a href="user_detail.php?id='.$result[id].'" class="badge badge-primary">Edit</a>';
        $view .='</td>';
        $view .='<td>';
        $view .= '<a href="user_delete.php?id='.$result[id].'" class="badge badge-danger">Delete</a>';
        $view .='</td>';
        $view .='</tr>';
    }
}

?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>todoリスト表示</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

    <header>
    <b><a style="font-size:50px" href="main.php">Art Online</a><br>
    <p style="float:right;font-size:20px;padding-right:25px">WELCOME  <?=$_SESSION["name"]?>!</p><br>
    <a href="logout.php">LOG OUT</a>

</header>

    <div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>lot</th>
                <th>image</th>
                <th>title</th>
                <th>artist</th>
                <th>EDIT</th>
                <th>DELETE</th>
            </tr>
        </thead>
        <tbody>
            <?=$view?>
        </tbody>
    </table>
</div>
</body>
<script>
</script>
</html>