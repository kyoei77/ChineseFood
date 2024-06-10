<?php
//DB接続に必要な情報
$login = "mysql:host=localhost;dbname=chinesefood;charset=utf8";
$db_id = "testuser";
$db_pass = "testpass";

//入力された情報の取得
if(isset($_POST["food_name"], $_POST["type"], $_FILES["food_image"]["name"], $_POST["introduction"])) {
    $foodname = $_POST["food_name"];
    $type = $_POST["type"];
    $foodimage = $_FILES["food_image"]["name"]; // POSTじゃないとfilesが持てない
    $introduction = $_POST["introduction"];

    // DBに接続します
    try {
        $dbh = new PDO($login, $db_id, $db_pass);
        // SQL文の用意
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
    } catch (PDOException $e) {
        echo "接続失敗...";
        echo "エラー内容:" . $e->getMessage();
    }
} else {
    echo "<p>必要な情報が提供されていません。</p>";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>新規登録</h1>
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
                <td>料理の説明:</td>
                <td>
                    <input type="text" name="introduction">
                </td>
            </tr>
            
        </table>
        <p><input type="submit" name="submit" value="送信"></p>
    </form>

    <p><a href="../homepage.html">ホームページへ</a></p> 
</body>
</html>
