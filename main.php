<?php
include('functions.php');

//DB接続
$pdo = db_conn();

//データ表示SQL作成
$sql = 'SELECT * FROM auction2019 ORDER BY id ASC';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//データ表示
$view='';
if ($status==false) {
    errorMsg($stmt);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $view .='<tr>';
        $view .='<td align="center">';
        // $view .= '<li class="list-group-item">';
        $view .= $result['lot'];
        $view .='</td>';
        $view .='<td align="center">';
        $view .='<img src="'.$result['image'].'" alt="" height="200">';
        $view .='</td>';
        $view .='<td align="center">';
        $view .= $result['title'];
        $view .='</td>';
        $view .='<td align="center">';
        $view .= $result['artist'];
        $view .='</td>';
        $view .='<td align="center">';
        $view .= '<a href="detail.php?id='.$result[id].'" class="badge badge-primary">BID</a>';
        $view .='</td>';
        $view .='<td align="center">';
        $view .='¥'.$result['price'];
        $view .='</td>';
        $view .='</tr>';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Art Online</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- <link rel="stylesheet" href="all.css"> -->
</head>
<body>
    <div class="mainbar">
    <b><a style="font-size:50px">Art Online</a></b>
    <div><b><a href="logout.php" style="float:right;padding-right:35px;font-size:20px;">LOG OUT</a></b></div>
    
<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr align="center">
                <th>LOT</th>
                <th>IMAGE</th>
                <th>TITLE</th>
                <th>ARTIST</th>
                <th>BID</th>
                <th>PRICE</th>
            </tr>
        </thead>
        <tbody>
            <?=$view?>
        </tbody>
    </table>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    
</html>