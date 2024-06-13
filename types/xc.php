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
    $sql = "SELECT * FROM foods WHERE type = 'xc'";
    // クエリの実行
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    // 取得した結果を配列として取得
    $xc_dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
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
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3628502.1402005213!2d108.88393264851787!3d27.36137337292659!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3420ba186987384d%3A0xcc21910be4ae2ce5!2z5Lit6I-v5Lq65rCR5YWx5ZKM5Zu9IOa5luWNl-ecgQ!5e0!3m2!1sja!2sjp!4v1717728789201!5m2!1sja!2sjp"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    <p>
        湘菜は、中国湖南省の郷土料理である。<br>
        その特徴は材料の幅が広く、油濃く色鮮やかで、唐辛子、燻製肉を多用する点にある。四川料理の辛さに酸味を加えた濃いめの味付けも特徴である。味付けは新鮮で香ばしく、酸味辛味が強く、柔らかく口当たりがよい。調理法は塩漬け肉、魚、燻製、蒸し焼き、蒸し物、煮込み、揚げ物、油炒めに長じている。
    </p>
    <h2>料理一覧</h2>
        <?php foreach ($xc_dishes as $dish) { ?>
            <?php if ($dish['flag'] != 0) { ?>

            <h3><?php echo $dish['foodname']; ?></h3>
            <img src=<?php echo $serverName.$dish["foodimage"]; ?> alt=<?php echo $serverName.$dish["foodimage"]; ?>>
            <p><?php echo $dish['introduction']; ?></p>
        <?php } ?>
        <?php } ?>
</body>

</html>