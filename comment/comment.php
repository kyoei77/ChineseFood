<?php
// DB接続に必要な情報
$login = "mysql:host=localhost;dbname=chinesefood;charset=utf8";
$db_id = "testuser";
$db_pass = "testpass";

// フォームから送信されたデータを取得
if(isset($_POST['food_id'], $_POST['name'], $_POST['comment'])) {
    $food_id = $_POST['food_id'];
    $name = $_POST['name'];
    $comment = $_POST['comment'];

    try {
        // データベースに接続
        $dbh = new PDO($login, $db_id, $db_pass);
        // SQL文の用意
        $sql = "INSERT INTO comments (food_id, name, comment) VALUES (:food_id, :name, :comment)";
        // プリペアドステートメントを準備
        $stmt = $dbh->prepare($sql);
        // プレースホルダに値をバインド
        $stmt->bindParam(':food_id', $food_id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        // クエリを実行
        $stmt->execute();
        // データベース接続をクローズ
        $dbh = null;
        // リダイレクトまたはメッセージ表示など、適切な処理を行う
        echo "コメントが保存されました。";
        
        
    } catch (PDOException $e) {
        // エラー処理
        echo "接続失敗...";
        echo "エラー内容:" . $e->getMessage();
    }
} else {
    // フォームからのデータが正しく送信されていない場合の処理
    echo "コメントを保存できませんでした。フォームから正しいデータが送信されていません。";
}
?>