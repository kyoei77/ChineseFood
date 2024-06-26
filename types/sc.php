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
    <title>Document</title>
</head>

<body>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3429658.0346196224!2d116.53663730489431!3d32.91732065834075!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x35b700da314bc245%3A0x8d94eab66c8553b5!2z5Lit6I-v5Lq65rCR5YWx5ZKM5Zu9IOaxn-iYh-ecgQ!5e0!3m2!1sja!2sjp!4v1717733286537!5m2!1sja!2sjp"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    <p>
        蘇菜は、中国の江蘇省に発祥した郷土料理で、中国八大料理（八大菜系）のひとつ。上海料理の原型であり、明の都であった南京、豪商が贅沢な料理を生み出した揚州、文人が多く集まった蘇州など、各地で異なる料理がある。<br>
        濃厚さの中に淡白さがあり、ふんわりとして香り高く、スープ出しは濃厚であるが嫌みがなく、口当たりは柔らかで甘味のある塩味がその特色。調理法は煮込み、遠火焼き、蒸し焼き、油炒めに長じている。調理する時には原材料を厳選して配色、盛り付けを重視する。
    </p>
    <h2>料理一覧</h2>
        <?php foreach ($sc_dishes as $dish) { ?>
            <?php if ($dish['flag'] != 0) { ?>

            <h3><?php echo $dish['foodname']; ?></h3>
            <img src=<?php echo $serverName.$dish["foodimage"]; ?> alt=<?php echo $serverName.$dish["foodimage"]; ?>>
            <p><?php echo $dish['introduction']; ?></p>
        <?php } ?>
        <?php } ?>
</body>

</html>