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
    <title>Document</title>
</head>

<body>
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

            <h3><?php echo $dish['foodname']; ?></h3>
            <img src=<?php echo $serverName.$dish["foodimage"]; ?> alt=<?php echo $serverName.$dish["foodimage"]; ?>>
            <p><?php echo $dish['introduction']; ?></p>
        <?php } ?>
        <?php } ?>
</body>

</html>