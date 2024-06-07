# CHINESEFOOD

データベースと接続
```
$dsn = "mysql:host=localhost;dbname=pets;charset=utf8";
$user = "testuser";
$pass = "testpass";

$dbh = new PDO($dsn, $user, $pass);
```
sql文の指定（プレースホルダー）
```
$sql = "SELECT * FROM users WHERE username=?";
$sql = "SELECT * FROM users WHERE username=? && password=?";
```
sql文の実行の準備
```
$stmt=$dbh -> prepare($sql); 
$stmt-> bindParam(1,$id);
$stmt->bindParam(2,$pass);
```
sql文の実行
```
$stmt->execute();
```
実行結果を連想配列に変換
```
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
```
パスワードの比較
```
    if ($input_pass == $result[0]["password"]) {
        header("Location: $new_location");
        exit; 
    } else {
        echo"<p>ユーザー名もしくはパスワード間違っています</p>";
    }
```