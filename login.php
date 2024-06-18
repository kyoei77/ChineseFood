<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理者ログインページ</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa;
        }

        .login-container {
            width: 380px; 
            margin: auto;
            padding: 20px;
            background-color: #ffffff; 
            border: 1px solid #cccccc; 
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); 
            text-align: center; 
        }

        h1 {
            margin-top: 0;
            color: #007bff; 
        }

        table {
            width: 100%;
        }

        table td {
            padding: 10px;
        }

        input[type="text"],
        input[type="password"] {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 10px;
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

        .error-message {
            color: red;
            font-size: 18px;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>ログイン</h1>
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

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
         if (isset($_POST["id"], $_POST["pass"])) {
    // ユーザー名とパスワードが送信された場合の処理
    $input_id = $_POST["id"];
    $input_pass = $_POST["pass"];

    //DB接続に必要な情報
    $login = "mysql:host=localhost;dbname=chinesefood;charset=utf8";
    $db_id = "testuser";
    $db_pass = "testpass";

    //データベースへ接続
    $dbh = new PDO($login, $db_id, $db_pass);

    //sql文の指定（プレースホルダー）
    $sql = "SELECT * FROM accounts WHERE usersid=? && password=?";

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
        $new_location = "./admin/admin.php";
        header("Location: $new_location");
        exit;
    } else {
        echo "<p style='color: red; font-size: 18px;text-align: center;'>ユーザー名またはパスワード間違っています</p>";
    }
            } else {
                echo "<p class='error-message'>ユーザー名とパスワードを入力してください。</p>";
            }
        }
        ?>
    </div>
</body>

</html>