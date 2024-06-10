<?php
//DB接続に必要な情報
$login = "mysql:host=localhost;dbname=chinesefood;charset=utf8";
$db_id = "testuser";
$db_pass = "testpass";

// foreach($_POST["food_image"] as $key => $value){
//     echo $key;
// }

var_dump($_FILES);


//入力された情報の取得
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
