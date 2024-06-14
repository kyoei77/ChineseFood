<?php
// DB接続に必要な情報
$login = "mysql:host=localhost;dbname=chinesefood;charset=utf8";
$db_id = "testuser";
$db_pass = "testpass";

$serverName = "..\\upload_file\\";

try {
    // データベースに接続
    $dbh = new PDO($login, $db_id, $db_pass);
    // SQL文の用意
    $sql = "SELECT * FROM foods WHERE type = 'mc'";
    // クエリの実行
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    // 取得した結果を配列として取得
    $mc_dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
} catch (PDOException $e) {
    echo "接続失敗...";
    echo "エラー内容:" . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mc</title>
    <link rel="stylesheet" href="./types_style.css">
</head>

<body>
    <h1>閩菜</h1>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3674835.509850109!2d115.65702600585735!3d25.9120155315621!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x341554d37044f9db%3A0x4eee34b4e4db50e8!2z5Lit6I-v5Lq65rCR5YWx5ZKM5Zu9IOemj-W7uuecgQ!5e0!3m2!1sja!2sjp!4v1717728847371!5m2!1sja!2sjp"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    <p>
        閩菜は、中華人民共和国福建省を中心に食べられている郷土料理。<br>
        その特色は色調が美しく、淡白で滋養があることで名高い。調理法は油いため、餡かけ、ソテー、煮込みに長じ、特に「酒糟味」は独特である。福建は東南の沿海に位置しているため、ハモ、アゲマキ、イカ、イシモチ、ナマコなどの海鮮が豊富で、それらを原材料とした調理法に独自なものがある。
    </p>
    <h2>料理一覧</h2>
    <?php foreach ($mc_dishes as $dish) { ?>
    <?php if ($dish['flag'] != 0) { ?>
    <table>
        <tr>
            <td>
                <h3>
                    <?php echo $dish['foodname']; ?>
                </h3>
                <img src=<?php echo $serverName . $dish["foodimage"]; ?> alt=
                <?php echo $serverName . $dish["foodimage"]; ?>>
                <p>
                    <?php echo $dish['introduction']; ?>
                    
                </p>
            </td>
            <td>
                <!-- コメント機能の追加 -->
                <h4> コメント</h4>
                <p>

                    この料理に対する感想やこの料理の作り方を共有したい方はぜひコメントしてください！<br>
                </p>

                <form action="../comment/comment.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="post">
                    <input type="hidden" name="dish_id" value="<?php echo $dish['id']; ?>">
                    <table>
                        <tr>
                            <td> お名前</td>
                            <td><input type="text" name="name" size="35"></td>
                        </tr>
                        <tr>
                            <td> メールアドレス</td>
                            <td><input type="text" name="mail" size="35"></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                コメント<br>
                                <textarea name="comment" cols="55" rows="6"></textarea>
                            </td>
                        </tr>
                    </table>
                    <input type="submit" name="send" value=" 投稿する">
                </form>
            </td>
        </tr>
        
    </table>
    
    
    <h4>コメント一覧</h4>
    <!-- その料理に関連するコメントを表示 -->
    <div class="comment">
        <?php
        // この料理に関連するコメントをデータベースから取得するクエリを実行する
        $comments_query = "SELECT * FROM comments WHERE dish_id = :dish_id";
        $stmt = $dbh->prepare($comments_query);
        $stmt->bindParam(':dish_id', $dish['id']);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // 取得したコメントを表示する
        foreach ($comments as $comment) {
            
            echo "<p class = 'name'>{$comment['name']}</p>";
            echo"<p>{$comment['comment']}</p>";
            echo "<p class = 'time'>{$comment['time']}</p>";
           
        }
    ?>
    </div>
    <!-- コメントフォームを表示 -->
    <!-- 以下にフォームを表示するコードを追加 -->
    <?php } ?>

    <?php } ?>
</body>

</html>