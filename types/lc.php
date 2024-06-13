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
    $sql = "SELECT * FROM foods WHERE type = 'lc'";
    // クエリの実行
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    // 取得した結果を配列として取得
    $lc_dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <title>lc</title>
</head>

<body>
    <h1>鲁菜</h1>

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3282681.8730565743!2d116.1307435416183!3d36.53616963393657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x358fcd4735ab4f7f%3A0xd93a2e2370e1b364!2z5Lit6I-v5Lq65rCR5YWx5ZKM5Zu9IOWxseadseecgQ!5e0!3m2!1sja!2sjp!4v1717728439533!5m2!1sja!2sjp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <p>
        魯菜は、中国の山東省に発祥した料理のことです。北京料理の原型であり中国語では「山東菜」または「魯菜」と呼ばれる。<br>
        山東料理の特徴は、味は香りがよくて塩辛く、歯ごたえはやわらかく、彩りが鮮やかでつくりは繊細なことである。透明なコンソメスープ（清湯）と白く芳醇な牛乳スープ（奶湯）がよく使われ、ねぎなどを香味料に使う。また海が近いことから海鮮を使った料理が多いのも特徴となっている。
    </p>
    <h2>料理一覧</h2>
    <?php foreach ($lc_dishes as $dish) { ?>
        <?php if ($dish['flag'] != 0) { ?>
        <h3><?php echo $dish['foodname']; ?></h3>
        <img src=<?php echo $serverName . $dish["foodimage"]; ?> alt=<?php echo $serverName . $dish["foodimage"]; ?>>
        <p><?php echo $dish['introduction']; ?></p>
    <?php } ?>
    <?php } ?>
</body>

</html>