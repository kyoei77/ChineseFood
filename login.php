<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            text-align: center;
            color: #007bff;
        }

        form {
            margin: 20px;
        }

        table {
            width: 100%;
        }

        table td {
            padding: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 10px;
        }

        input[type="submit"]:hover {
            background-color: white;
            color: #007bff;
        }
    </style>
</head>

<body>
    <h1>管理者ログインページ</h1>
    <form action="login.php" method="post">
        <table>
            <tr>
                <td>ユーザー名</td>
                <td><input type="text" name="id" value=""></td>
            </tr>
            <tr>
                <td>パスワード</td>
                <td><input type="password" name="pass"></td>
            </tr>
        </table>
        <input type="submit" value="ログイン">
    </form>
</body>

</html>

<?php

//入力された数値の取得
if (isset($_POST["id"], $_POST["pass"])) {
    // ユーザー名とパスワードが送信された場合の処理
    $input_id = $_POST["id"];
    $input_pass = $_POST["pass"];

    // 以降のログイン処理を行う


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
    $stmt->bindParam(1, $input_id);
    $stmt->bindParam(2, $input_pass);

    //sql文の実行
    $stmt->execute();

    //実行結果を連想配列に変換
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // パスワードの比較
    if ($stmt->rowCount() > 0 && $input_pass == $result[0]["password"]) {
        // echo "ログイン完了";
        $new_location = "./admin/admin.php";
        header("Location: $new_location");
        exit;
    } else {
        echo "<p style='color: red; font-size: 18px;text-align: center;'>ユーザー名またはパスワード間違っています</p>";
    }
} else {
    // ユーザー名とパスワードが送信されなかった場合の処理
    echo "<p style='color: red; font-size: 18px; text-align: center;'>ユーザー名とパスワードを入力してください。</p>";
}


?>