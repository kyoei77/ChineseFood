<?php
// DB接続に必要な情報
$login = "mysql:host=localhost;dbname=chinesefood;charset=utf8";
$db_id = "testuser";
$db_pass = "testpass";

// データベースから料理の情報を取得
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $dbh = new PDO($login, $db_id, $db_pass);
        // SQL文の用意
        $sql = "SELECT * FROM foods WHERE id=?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $food = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "エラー：" . $e->getMessage();
        exit();
    }
}

// フォームが送信された場合はデータベースに変更を保存
if (isset($_POST['submit'])) {
    $foodname = $_POST['food_name'];
    $type = $_POST['type'];
    $introduction = $_POST["introduction"];

    // 画像の処理
    $serverName = "..\\upload_file\\";
    if (isset($_FILES["food_image"]) && $_FILES["food_image"]["name"] !== '') {
        $foodimage = $_FILES["food_image"]["name"];
        move_uploaded_file($_FILES['food_image']['tmp_name'], $serverName . $_FILES['food_image']['name']);
    } else {
        // ファイルがアップロードされていない場合は元の画像をそのまま利用する
        $foodimage = $food['foodimage'];
    }

    try {
        $dbh = new PDO($login, $db_id, $db_pass);
        // 更新用のSQL文の用意
        $sql = "UPDATE foods SET foodname=?, type=?, foodimage=?, introduction=? WHERE id=?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $foodname);
        $stmt->bindParam(2, $type);
        $stmt->bindParam(3, $foodimage);
        $stmt->bindParam(4, $introduction);
        $stmt->bindParam(5, $id);
        $stmt->execute();

        echo "料理が更新されました。";

        // 更新後の料理情報を取得
        $sql = "SELECT * FROM foods WHERE id=?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $food = $stmt->fetch(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "エラー：" . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>料理の編集</title>
    <link rel="stylesheet" href="admin3.css">
</head>

<body>
    <h1>料理の編集</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>料理名:</td>
                <td><input type="text" name="food_name" value="<?php echo htmlspecialchars($food['foodname']); ?>"></td>
            </tr>
            <tr>
                <td>料理の種類:</td>
                <td>
                    <select name="type">
                        <option value="cc" <?php if ($food['type'] == 'cc') echo 'selected'; ?>>川菜（四川料理）</option>
                        <option value="hc" <?php if ($food['type'] == 'hc') echo 'selected'; ?>>徽菜（安徽料理）</option>
                        <option value="lc" <?php if ($food['type'] == 'lc') echo 'selected'; ?>>魯菜（山東料理）</option>
                        <option value="yc" <?php if ($food['type'] == 'yc') echo 'selected'; ?>>粤菜（広東料理）</option>
                        <option value="mc" <?php if ($food['type'] == 'mc') echo 'selected'; ?>>閩菜（福建料理）</option>
                        <option value="sc" <?php if ($food['type'] == 'sc') echo 'selected'; ?>>蘇菜（江蘇料理）</option>
                        <option value="zc" <?php if ($food['type'] == 'zc') echo 'selected'; ?>>浙菜（浙江料理）</option>
                        <option value="xc" <?php if ($food['type'] == 'xc') echo 'selected'; ?>>湘菜（湖南料理）</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>料理の写真</td>
                <td>
                    <?php if (!empty($food['foodimage'])): ?>
                        <img src="<?php echo htmlspecialchars($food['foodimage']); ?>" alt="料理の写真" style="max-width: 300px;">
                        <br>
                    <?php endif; ?>
                    <input type="file" name="food_image">
                </td>
            </tr>
            <tr>
                <td>料理の説明:</td>
                <td><textarea name="introduction" style="height: 150px; width: 300px;"><?php echo htmlspecialchars($food['introduction']); ?></textarea></td>
            </tr>
        </table>
        <input type="submit" name="submit" value="更新">
    </form>
    <a href="./admin.php">前のページへ</a>
</body>

</html>
