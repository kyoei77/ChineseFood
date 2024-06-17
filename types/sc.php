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
    $sql = "SELECT * FROM foods WHERE type = 'sc'";
    // クエリの実行
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    // 取得した結果を配列として取得
    $sc_dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
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
    <title>sc</title>
    <link rel="stylesheet" href="./types_style.css">
</head>

<body>
    <h1>蘇菜</h1>
    <a href="../homepage.html" class="return">戻る</a>
    <p class="intro">
    &emsp;蘇菜は、中国の江蘇省に発祥した郷土料理で、中国八大料理（八大菜系）のひとつ。上海料理の原型であり、明の都であった南京、豪商が贅沢な料理を生み出した揚州、文人が多く集まった蘇州など、各地で異なる料理がある。<br>
    &emsp;濃厚さの中に淡白さがあり、ふんわりとして香り高く、スープ出しは濃厚であるが嫌みがなく、口当たりは柔らかで甘味のある塩味がその特色。調理法は煮込み、遠火焼き、蒸し焼き、油炒めに長じている。調理する時には原材料を厳選して配色、盛り付けを重視する。
    </p>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3429658.0346196224!2d116.53663730489431!3d32.91732065834075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x35b700da314bc245%3A0x8d94eab66c8553b5!2z5Lit6I-v5Lq65rCR5YWx5ZKM5Zu9IOaxn-iYh-ecgQ!5e0!3m2!1sja!2sjp!4v1717733286537!5m2!1sja!2sjp"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    <h2>料理一覧</h2>
    <?php foreach ($sc_dishes as $dish) { ?>
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
                <p class="commentform">

                    この料理に対する感想やこの料理の作り方を共有したい方はぜひコメントしてください！<br>
                </p>

                <form action="../comment/comment.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="mode" value="post">
                    <input type="hidden" name="dish_id" value="<?php echo $dish['id']; ?>">
                    <table>
                        <tr>
                            <td>ユーザー名</td>
                            <td><input type="text" name="name" size="35"></td>
                        </tr>
                        <tr>
                            <td> メールアドレス</td>
                            <td><input type="text" name="email" size="35"></td>
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
        if(!empty($comments)){
            echo"<h4>コメント一覧</h4>";
            foreach ($comments as $comment) {
            
            echo "<p class = 'name'>{$comment['name']}</p>";
            echo"<p>{$comment['comment']}</p>";
            echo "<p class = 'time'>{$comment['time']}</p>";
           
        }
    }
    else{
        echo"<p class='nocomment'>コメントをお待ちしています！</p>";
    }
        
    ?>
        
    </div>

    <!-- コメントフォームを表示 -->
    <!-- 以下にフォームを表示するコードを追加 -->
    <?php } ?>

    <?php } ?>

</body>

</html>