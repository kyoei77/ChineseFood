<?php
$login = "mysql:host=localhost;dbname=chinesefood;charset=utf8";
$db_id = "testuser";
$db_pass = "testpass";

$serverName = ".\\upload_file\\";
try {
    // データベースに接続
    $dbh = new PDO($login, $db_id, $db_pass);
    $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : null;
    $keyword = "%" . $keyword . "%";
    if (!empty($keyword)) {
        $sql = "SELECT * FROM foods WHERE foodname LIKE ?";
        // プレイスホルダー
        $stmt = $dbh->prepare($sql);
        // $stmt->bindParam(1, $id);
        $stmt->bindParam(1, $keyword);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    // エラー処理
    echo "接続失敗: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>検索結果</title>
</head>

<body>
    <h2>検索結果一覧</h2>
    
    <?php if (!empty($result)) { ?>
        <?php foreach ($result as $value) { ?>
            <?php if ($value['flag'] != 0) { ?>
                <h3><?php echo $value['foodname']; ?></h3>
                <img src=<?php echo $serverName . $value["foodimage"]; ?> alt=<?php echo $serverName . $value["foodimage"]; ?>>
                <p><?php echo $value['introduction']; ?></p>
            <?php } ?>
        <?php } ?>
    <?php } else { ?>
        <?php echo "検索結果がありません。"; ?>
    <?php }  ?>

</body>

</html>




