<?php

//DB接続に必要な情報
$login = "mysql:host=localhost;dbname=chinesefood;charset=utf8";
$db_id = "testuser";
$db_pass = "testpass";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $dbh = new PDO($login, $db_id, $db_pass);
        // SQL文の用意
        $sql = "UPDATE foods SET flag =0 WHERE id=?";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        //管理者画面に戻る
        header("Location: ./admin.php");
        exit();
    } catch (PDOException $e) {
        echo "削除に失敗しました。エラー内容:" . $e->getMessage();
    }
} 
?>