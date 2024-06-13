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
    $sql = "SELECT * FROM foods WHERE type = 'hc'";
    // クエリの実行
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    // 取得した結果を配列として取得
    $hc_dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
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
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3464695.8180707656!2d114.62428009109763!3d32.00178365872384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3434a48ca17082d7%3A0x7aa8d6156e75706d!2z5Lit6I-v5Lq65rCR5YWx5ZKM5Zu9IOWuieW-veecgQ!5e0!3m2!1sja!2sjp!4v1717733394825!5m2!1sja!2sjp"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    <p>
        徽菜は、中国安徽省の郷土料理。福州、泉州、アモイなどの地方料理を代表として発達している。<br>
        その特徴は原材料選定が質朴で、火の使い方を重視し、油がきつく色鮮やかで、スープだし、原材料本来の味を維持することにある。調理法は遠火焼き、煮込み、煮物に長じている。

    </p>
    <h2>料理一覧</h2>
        <?php foreach ($hc_dishes as $dish) { ?>
            <?php if ($dish['flag'] != 0) { ?>
            <h3><?php echo $dish['foodname']; ?></h3>
            <img src=<?php echo $serverName.$dish["foodimage"]; ?> alt=<?php echo $serverName.$dish["foodimage"]; ?>>
            <p><?php echo $dish['introduction']; ?></p>
        <?php } ?>
        <?php } ?>
</body>

</html>