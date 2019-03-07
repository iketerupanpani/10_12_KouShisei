<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>login</title>
</head>

<body>

 <div class="mainbar">
    <b><a style="font-size:50px">Art Online</a></b><br>
</div>

    <form action="login_act.php" method="post">
        <div>
            <label for="lid" style="padding-right:19px;font-weight:bold;">LoginID</label>
            <input type="text" id="lid" name="lid" placeholder="Enter LoginID">
        </div>
        <div>
            <label for="lpw" style="font-weight:bold;">Password</label>
            <input type="password" id="lpw" name="lpw" placeholder="Enter 5~8 letters"><br>
            <button type="submit" style="font-weight: bold;">Go</button>
        </div>
    </form>
<script>

</script>
</body>

</html>