<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>お気に入りを登録</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
        div{
            padding: 10px;
            font-size:16px;
            }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">お気に入りを登録</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">お気に入り登録</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="select.php">お気に入り一覧</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- 必要な属性を追加 -->
    <form method="post" action="insert_file.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="lot">lot</label>
            <input type="text" class="form-control" id="lot" name="lot">
        </div>
        <div class="form-group">
            <label for="title">title</label>
            <input type="text" class="form-control" id="title" name="title">
        </div>
        <div class="form-group">
            <label for="artist">artist</label>
            <input type="text" class="form-control" id="artist" name="artist">
        </div>
        <div class="form-group">
            <label for="memo">memo</label>
            <textarea class="form-control" id="memo" name="memo" rows="3"></textarea>
        <div class="form-group">
            <label for="price">price</label>
            <input type="text" class="form-control" id="price" name="price">
        </div>

        <div class="form-group">
            <label for="upfile">Image</label>
            <!-- inputを追加 -->
            <input type="file" class="form-control-file" id="upfile" name="upfile" accept="image/*,audio/*" capture="camera" >
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

</body>

</html>