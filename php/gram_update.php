<?php

// 送信データのチェック
// var_dump($_POST);
// exit();

// 関数ファイルの読み込み
include("functions.php");

// 送信データ受け取り

$id = $_POST["id"];

$users_id = $_POST['users_id'];
$users_password = $_POST['users_password'];
$is_admin = $_POST['is_admin'];
$is_deleted = $_POST['is_deleted'];
$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$last_name_kana = $_POST['last_name_kana'];
$first_name_kana = $_POST['first_name_kana'];
$nick_name = $_POST['nick_name'];
$users_location = $_POST['users_location'];
$cource = $_POST['cource'];
$ki = $_POST['ki'];
$touitsu_ki = $_POST['touitsu_ki'];

// var_dump($last_name);


// DB接続
$pdo = connect_to_db();

// UPDATE文を作成&実行
$sql = "UPDATE gram_table 
        SET users_id=:users_id, 
            users_password=:users_password, 
            is_admin=:is_admin, 
            is_deleted=:is_deleted, 
            last_name=:last_name, 
            first_name=:first_name, 
            last_name_kana=:last_name_kana, 
            first_name_kana=:first_name_kana, 
            nick_name=:nick_name, 
            users_location=:users_location, 
            cource=:cource, 
            ki=:ki, 
            touitsu_ki=:touitsu_ki,
            updated_at=sysdate()
        WHERE id=:id";

// var_dump($sql);
// exit;

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$stmt->bindValue(':users_id', $users_id, PDO::PARAM_INT);
$stmt->bindValue(':users_password', $users_password, PDO::PARAM_INT);
$stmt->bindValue(':is_admin', $is_admin, PDO::PARAM_INT);
$stmt->bindValue(':is_deleted', $is_deleted, PDO::PARAM_INT);
$stmt->bindValue(':last_name', $last_name, PDO::PARAM_INT);
$stmt->bindValue(':first_name', $first_name, PDO::PARAM_INT);
$stmt->bindValue(':last_name_kana', $last_name_kana, PDO::PARAM_INT);
$stmt->bindValue(':first_name_kana', $first_name_kana, PDO::PARAM_INT);
$stmt->bindValue(':nick_name', $nick_name, PDO::PARAM_INT);
$stmt->bindValue(':users_location', $users_location, PDO::PARAM_INT);
$stmt->bindValue(':cource', $cource, PDO::PARAM_INT);
$stmt->bindValue(':ki', $ki, PDO::PARAM_INT);
$stmt->bindValue(':touitsu_ki', $touitsu_ki, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
  header("Location:gram_read.php");
  exit();
}
