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
    $sql = "SELECT * FROM foods WHERE type = 'cc'";
    // クエリの実行
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    // 取得した結果を配列として取得
    $cc_dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
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
    <title>cc</title>
</head>
<body>
    <h1>川菜</h1>
    <p>川菜は、狭義には、中国四川省の郷土料理。広義には、重慶市、雲南省、貴州省などの周辺地域をも含めた、共通する特徴をもつ郷土料理の系統を指す。 <br>
        酸味、甘み、痺れる辛さ、辛み、巧みな醤油、濃厚な味付けが特徴で、調味料として三椒（唐辛子、胡椒、花山椒）と生姜は欠かすことができず、他の地方には余り見られない辛味、酸味、痺れる辛さのある料理として人々に知られ親しまれている。
    </p>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14327133.983074326!2d83.47705587647891!3d28.754329650532064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x36e4e73368bdcdb3%3A0xde8f7ccf8f99feb9!2z5Lit6I-v5Lq65rCR5YWx5ZKM5Zu9IOWbm-W3neecgQ!5e0!3m2!1sja!2sjp!4v1717728521971!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        <h2>料理一覧</h2>
        <?php foreach ($cc_dishes as $dish) { ?>
            <h3><?php echo $dish['foodname']; ?></h3>
            <img src=<?php echo $serverName.$dish["foodimage"]; ?> alt=<?php echo $serverName.$dish["foodimage"]; ?>>
            <p><?php echo $dish['introduction']; ?></p>
        <?php } ?>
        
    
   
</body>
</html>


