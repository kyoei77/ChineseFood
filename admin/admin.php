<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>料理の新規登録</title>
    <link rel="stylesheet" href="admin1.css">
</head>

<body>
    <h1>料理の新規登録</h1>
    <p class="back-link"><a href="../homepage.html">ホームページへ</a></p>
    <form action="./admin.php" method="post" enctype="multipart/form-data">
        <table>
            <tr>
                <td>料理名:</td>
                <td>
                    <input type="text" name="food_name" value="">
                </td>
            </tr>
            <tr>
                <td>料理の種類:</td>
                <td>
                    <select name="type">
                        <option value="cc">川菜（四川料理）</option>
                        <option value="hc">徽菜（安徽料理）</option>
                        <option value="lc">魯菜（山東料理）</option>
                        <option value="mc">閩菜（福建料理）</option>
                        <option value="sc">蘇菜（江蘇料理）</option>
                        <option value="xc">湘菜（湖南料理）</option>
                        <option value="yc">粤菜（広東料理）</option>
                        <option value="zc">浙菜（浙江料理）</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>料理の写真</td>
                <td>

                    <input type="file" name="food_image">

                </td>
            </tr>
            <tr>
                <td >料理の説明:</td>
                <td>
                    <textarea name="introduction" ></textarea>
                </td>
            </tr>

        </table>
        <p><input type="submit" name="submit" value="送信"></p>
    </form>
</body>

</html>



<!-- //データの追加機能の作成 -->
<?php
//DB接続に必要な情報
$login = "mysql:host=localhost;dbname=chinesefood;charset=utf8";
$db_id = "testuser";
$db_pass = "testpass";
//画像をアップロードために
$serverName = "..\\upload_file\\";

//入力された情報の取得
if (isset($_POST["food_name"], $_POST["type"], $_FILES["food_image"]["name"], $_POST["introduction"])) {
    $foodname = $_POST["food_name"];
    $type = $_POST["type"];
    $serverName = "..\\upload_file\\";
    $foodimage = $_FILES["food_image"]["name"];
    $introduction = $_POST["introduction"];

    // DBに接続します
    try {
        $dbh = new PDO($login, $db_id, $db_pass);
        // 追加用のSQL文の用意
        $sql = <<<SQL
        INSERT INTO foods (
            `foodname`,
            `type`, 
            `foodimage`,
            `introduction`
        ) VALUES (
            '$foodname',
            '$type', 
            '$foodimage', 
            '$introduction' 
        )
       SQL;
        $dbh->query($sql);
        echo "<p>登録されました。</p>";
        //画像ををローカルに保存する
        move_uploaded_file($_FILES['food_image']['tmp_name'], $serverName . $_FILES['food_image']['name']);
    } catch (PDOException $e) {
        echo "接続失敗...";
        echo "エラー内容:" . $e->getMessage();
    }
} else {
    echo "<p>送信してください。</p>";
}

//一覧表用の全部のデータを取り出す
try {
    $dbh = new PDO($login, $db_id, $db_pass);
    // 取り出すSQL文の用意
    $sql = "SELECT * FROM foods";
    $stmt = $dbh->query($sql);
    $foods = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "接続失敗...";
    echo "エラー内容:" . $e->getMessage();
}

//英語表記である略称から漢字表記に変更して、配列に入れる
$foods1 = [];
foreach ($foods as $food) {

    $food1 =[];
    switch ($food["type"]) {
        case "cc":
            $food1 = array_merge($food, array('typefood' => "川菜（四川料理）"));
            break;
        case "hc":
            $food1 = array_merge($food, array('typefood' => "徽菜（安徽料理)"));
            break;
        case "lc":
            $food1 = array_merge($food, array('typefood' => "魯菜（山東料理）"));
            break;
        case "mc":
            $food1 = array_merge($food, array('typefood' => "閩菜（福建料理）"));
            break;
        case "sc":
            $food1 = array_merge($food, array('typefood' => "蘇菜（江蘇料理）"));
            break;
        case "xc":
            $food1 = array_merge($food, array('typefood' => "湘菜（湖南料理）"));
            break;
        case "yc":
            $food1 = array_merge($food, array('typefood' => "粤菜（広東料理）"));
            break;
        case "zc":
            $food1 = array_merge($food, array('typefood' => "浙菜（浙江料理）"));
            break;
    }
    
    $foods1[] = $food1;
    
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録された料理一覧</title>
    <link rel="stylesheet" href="admin2.css">
    
</head>

<body>
    
    <h1>登録された料理一覧</h1>
    <table border="1">
        <tr>
            <th>料理名</th>
            <th>種類</th>
            <th>写真</th>
            <th style="width:800px;">説明</th>
        </tr>
        <!-- 表示するため -->
        <?php foreach ($foods1 as $food) { ?>
            <?php if ($food['flag'] != 0) { ?>
                <tr>
                    <td text-align="center"><?php echo $food['foodname']; ?></td>
                    <td><?php echo $food['typefood']; ?></td>
                    <td><a href=<?php echo $serverName . $food['foodimage']; ?>>image</a></td>
                    <td><?php echo $food['introduction']; ?></td>
                    <td><a href="./delete_food.php?id=<?php echo $food['id']; ?>" onclick="return confirm('この料理を削除しますか？')">削除</a></td>
                    <td><a href="./edit_food.php?id=<?php echo $food['id']; ?>">編集</a></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
    <!-- ホームページに戻る -->
    
</body>

</html>