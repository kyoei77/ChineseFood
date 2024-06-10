<?php

//入力された数値の取得
$input_id = $_POST["id"];
$input_pass = $_POST["pass"];


//DB接続に必要な情報
$login = "mysql:host=localhost;dbname=account;charset=utf8";
$db_id = "testuser";
$db_pass = "testpass";

//データベースへ接続
$dbh = new PDO($login, $db_id, $db_pass);

//sql文の指定（プレースホルダー）
$sql = "SELECT * FROM accounts WHERE id=? && password=?";

//sql文の実行の準備
$stmt = $dbh->prepare($sql); 
$stmt-> bindParam(1,$input_id);
$stmt->bindParam(2,$input_pass);

//sql文の実行
$stmt->execute();

//実行結果を連想配列に変換
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// パスワードの比較
if ($input_pass == $result[0]["password"]) {
    // echo "ログイン完了";
    $new_location = "../admin/admin.php";
    header("Location: $new_location");
    exit; 
}
 else 
{
    echo"<p>パスワード間違っています</p>";
}
?>