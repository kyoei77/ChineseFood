<?php
// DB接続に必要な情報
$login = "mysql:host=localhost;dbname=chinesefood;charset=utf8";
$db_id = "testuser";
$db_pass = "testpass";


try {
    // データベースに接続
    $dbh = new PDO($login, $db_id, $db_pass);
    // データベースエラー時に例外をスローする設定
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    
    
        // POSTデータからコメントを受け取る
        $dish_id = $_POST['dish_id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];
        
        // データベースにコメントを挿入するクエリを準備
       $sql = "INSERT INTO comments (dish_id, name, email, comment) VALUES (?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        
        // パラメータをバインド
        $stmt->bindParam(1, $dish_id);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $comment);
        
        // クエリを実行
        $stmt->execute();


        $sqltype = "SELECT type FROM foods WHERE id = ?";
        $stmt2 = $dbh->prepare($sqltype);
        
        // パラメータをバインド
        $stmt2->bindParam(1, $dish_id);
        // クエリを実行
        $stmt2->execute();
        $typefood = $stmt2->fetch();
        $type = $typefood["type"];
        
        // 成功したらリダイレクトするなどの処理を行う
        // 例えば、コメントが追加されたページにリダイレクトする場合は以下のようにする
        
        echo"<p>コメントしました。</p>";
        // exit();
    
} catch (PDOException $e) {
    // エラーが発生した場合の処理
    echo "接続失敗...";
    echo "エラー内容:" . $e->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <input type="button" value="前画面に戻る" onclick="location.href='../types/<?php echo"$type"; ?>.php'">
</body>
</html>