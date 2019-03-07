<?php
// セッションのスタート
session_start();

include('functions.php');


// getで送信されたidを取得
$id = $_GET['id'];

//DB接続します
$pdo = db_conn();

//データ登録SQL作成，指定したidのみ表示する
$sql = 'SELECT * FROM auction2019 WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//データ表示
if ($status==false) {
    // エラーのとき
    errorMsg($stmt);
} else {
    // エラーでないとき
    $rs = $stmt->fetch();
    // fetch()で1レコードを取得して$rsに入れる
    // $rsは配列で返ってくる．$rs["id"], $rs["task"]などで値をとれる
    // var_dump()で見てみよう
    //  var_dump($rs);
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BID</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
        div{
            padding: 10px;
            font-size:16px;
            }
    </style>
</head>

<body>

 <div class="mainbar">
    <b><a style="font-size:50px" href="home.php">Art Online</a></b><br>
 </div>

    <form method="post" action="update.php">
     <div style="float:left;width:50%;padding-left:30px">
        <img src='<?=$rs['image']?>' alt="" height="500">
     </div> 
       <div style="float:right;width:30%">
        <div class="form-group">
            <b><label for="lot">LOT</label></b>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <?=$rs['lot']?> 
        </div>
        <div class="form-group">
            <b><label for="title">TITLE</label></b>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <?=$rs['title']?>
        </div>
        <div class="form-group">
            <b><label for="artist">ARTIST</label></b>
            <!-- 受け取った値をvaluesに埋め込もう -->
            <?=$rs['artist']?>
        </div>
        <div class="form-group">
            <b><label for="price">PRICE</label></b>
            <!-- 受け取った値をvaluesに埋め込もう -->
            ¥<?=$rs['price']?>
        </div>
        <div>
            <label for="price">BID</label>
            <input type="price" id="price" name="price" placeholder="Enter price">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">BID</button>
            <a type="back" class="btn btn-primary" href="main.php">BACK</a>

        </div>

        <!-- idは変えたくない = ユーザーから見えないようにする-->
        <input type="hidden" name="id" value="<?=$rs['id']?>">
        <a class="time" id="countOutput" style="padding-left:5px"></a>
</div>
</form>

<script>
    function dateCounter() {

        var timer = setInterval(function () {
            //現在の日時取得
            var nowDate = new Date();
            //カウントダウンしたい日を設定
            var anyDate = new Date("2019/3/27 19:00:00");
            //日数を計算
            var daysBetween = Math.ceil((anyDate - nowDate) / (1000 * 60 * 60 * 24));
            var ms = (anyDate - nowDate);
            if (ms >= 0) {
                //時間を取得
                var h = Math.floor(ms / 3600000);
                var _h = h % 24;
                //分を取得
                var m = Math.floor((ms - h * 3600000) / 60000);
                //秒を取得
                var s = Math.round((ms - h * 3600000 - m * 60000) / 1000);

                //HTML上に出力
                document.getElementById("countOutput").innerHTML =  daysBetween + "days & " +_h + "：" + m + "：" +s +  "  UNTIL LOTS CLOSE";

                if ((h == 0) && (m == 0) && (s == 0)) {
                    clearInterval(timer);
                    document.getElementById("countOutput").innerHTML = "See you next auction.";
                }
            } else {
                document.getElementById("countOutput").innerHTML = "See you next auction.";
            }
        }, 1000);
    }
    dateCounter();
</script>
    
</body>

</html>