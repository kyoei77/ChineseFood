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
    $sql = "SELECT * FROM foods WHERE type = 'zc'";
    // クエリの実行
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    // 取得した結果を配列として取得
    $zc_dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
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
    <title>zc</title>
    <link rel="stylesheet" href="./types_style.css">
</head>

<body>
    <h1>浙菜</h1>
    <a href="../homepage.html" class="return">戻る</a>
    <p class="intro">
    &emsp;浙菜は、中国浙江省に発祥した料理。<br>
    &emsp;調理法はよく研究されており精緻で変化に富み、料理や盛り付けは鮮やかで、歯ごたえはやわらかく、味付けは塩味でさっぱりとしている。この地域特産の上質で新鮮な素材を選び、その持ち味やさわやかさを引き出すことが特徴である。鮮やかで美しい盛り付けにはこの地方独特の山水の美しさが反映しており、蘇軾（蘇東坡）の名と逸話に由来する東坡肉をはじめとして、浙江地域の歴史につながる逸話がある料理も多い。
    </p>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3570652.887852991!2d117.86496175110162!3d29.077158205435396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x34491234a50accbf%3A0x81ef71c536187cb7!2z5Lit6I-v5Lq65rCR5YWx5ZKM5Zu9IOa1meaxn-ecgQ!5e0!3m2!1sja!2sjp!4v1717733085965!5m2!1sja!2sjp"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    <h2>料理一覧</h2>
    <?php foreach ($zc_dishes as $dish) { ?>
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