<?php
// var_dump($_POST);
// exit();


// 外部ファイル読み込み
// DB接続します

// セッションの開始
session_start();

// 関数ファイル読み込み 
include('functions.php');

// DB接続
$pdo = connect_to_db();

// データ受け取り→変数に入れる
$users_id = $_POST['users_id'];
$users_password = $_POST['users_password'];

// データ取得SQL作成&実行

$sql = 'SELECT * FROM gram_table 
        WHERE users_id=:users_id 
        AND users_password=:users_password 
        AND is_deleted=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':users_id', $users_id, PDO::PARAM_STR);
$stmt->bindValue(':users_password', $users_password, PDO::PARAM_STR);
$status = $stmt->execute();

// SQL実行時にエラーがある場合はエラーを表示して終了
$val = $stmt->fetch(PDO::FETCH_ASSOC); // 該当レコードだけ取得 
if (!$val) {
  echo "<p>ログイン情報に誤りがあります.</p>";
  echo '<a href="gram_login.php">login</a>';
  exit();
} else {
  $_SESSION = array(); // セッション変数を空にする 
  $_SESSION["session_id"] = session_id();
  $_SESSION["is_admin"] = $val["is_admin"];
  $_SESSION["users_id"] = $val["users_id"];
  header("Location:gram_read.php");
  exit();
}


// うまくいったらデータ（1レコード）を取得
$val = $stmt->fetch(PDO::FETCH_ASSOC);

// ユーザ情報が取得できない場合はメッセージを表示
if (!$val) {
  echo "<p>ログイン情報に誤りがあります．</p>";
  echo '<a href="todo_login.php">login</a>';
  exit();
} else {
  // ログインできたら情報をsession領域に保存して一覧ページへ移動

}
