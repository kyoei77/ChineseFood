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
    $sql = "SELECT * FROM foods WHERE type = 'yc'";
    // クエリの実行
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    // 取得した結果を配列として取得
    $yc_dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
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
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5541783.188223793!2d114.63594537145963!3d25.135407498569396!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x315285f132af5c3f%3A0x2ed41c6f09259f29!2z5Lit6I-v5Lq65rCR5YWx5ZKM5Zu9IOW6g-adseecgQ!5e0!3m2!1sja!2sjp!4v1717733201056!5m2!1sja!2sjp"
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade"></iframe>
    <p>
        粤菜は中国南部の広東省、香港、マカオ及び海外の広東系住民の居住地区で食べられている料理。<br>
        その特徴は、野菜などの持ち味を生かした、薄味の炒め物や蒸し魚、スペアリブ、餃子などの蒸し物が基本であるが、土鍋で煮る「煲」（ポウ）や、叉焼などのロースト「燒」（シウ）、たれで煮る「炆」（マン）、くずれるほど煮込む「熬」（アーウ）などもある。
    </p>
    <h2>料理一覧</h2>
        <?php foreach ($yc_dishes as $dish) { ?>
            <?php if ($dish['flag'] != 0) { ?>
            <h3><?php echo $dish['foodname']; ?></h3>
            <img src=<?php echo $serverName.$dish["foodimage"]; ?> alt=<?php echo $serverName.$dish["foodimage"]; ?>>
            <p><?php echo $dish['introduction']; ?></p>
        <?php } ?>
        <?php } ?>
</body>

</html>