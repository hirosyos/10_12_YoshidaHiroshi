<?php
session_start();

include("functions.php");
check_session_id();

// 送信確認
// var_dump($_POST);
// exit();

// 項目入力のチェック
// 値が存在しないor空で送信されてきた場合はNGにする
if (
  !isset($_POST['users_id']) || $_POST['users_id'] == '' ||
  !isset($_POST['users_password']) || $_POST['users_password'] == '' ||
  !isset($_POST['is_admin']) || $_POST['is_admin'] == '' ||
  !isset($_POST['is_deleted']) || $_POST['is_deleted'] == '' ||
  !isset($_POST['last_name']) || $_POST['last_name'] == '' ||
  !isset($_POST['first_name']) || $_POST['first_name'] == '' ||
  !isset($_POST['last_name_kana']) || $_POST['last_name_kana'] == '' ||
  !isset($_POST['first_name_kana']) || $_POST['first_name_kana'] == '' ||
  !isset($_POST['nick_name']) || $_POST['nick_name'] == '' ||
  !isset($_POST['users_location']) || $_POST['users_location'] == '' ||
  !isset($_POST['cource']) || $_POST['cource'] == '' ||
  !isset($_POST['touitsu_ki']) || $_POST['touitsu_ki'] == ''
) {
  // 項目が入力されていない場合はここでエラーを出力し，以降の処理を中止する
  echo json_encode(["error_msg" => "no input"]);
  exit();
}

// 受け取ったデータを変数に入れる

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

// DB接続
$pdo = connect_to_db();

// データ登録SQL作成
// `created_at`と`updated_at`には実行時の`sysdate()`関数を用いて実行時の日時を入力する
$sql = 'INSERT INTO gram_table(id, users_id, users_password, is_admin, is_deleted,created_at,updated_at,last_name,first_name,last_name_kana,first_name_kana,nick_name,users_location,cource,ki,touitsu_ki) 
                      VALUES(NULL, :users_id, :users_password,:is_admin,:is_deleted,sysdate(), sysdate(),:last_name,:first_name,:last_name_kana,:first_name_kana,:nick_name,:users_location,:cource,:ki,:touitsu_ki)';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':users_id', $users_id, PDO::PARAM_STR);
$stmt->bindValue(':users_password', $users_password, PDO::PARAM_STR);
$stmt->bindValue(':is_admin', $is_admin, PDO::PARAM_STR);
$stmt->bindValue(':is_deleted', $is_deleted, PDO::PARAM_STR);
$stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
$stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
$stmt->bindValue(':last_name_kana', $last_name_kana, PDO::PARAM_STR);
$stmt->bindValue(':first_name_kana', $first_name_kana, PDO::PARAM_STR);
$stmt->bindValue(':nick_name', $nick_name, PDO::PARAM_STR);
$stmt->bindValue(':users_location', $users_location, PDO::PARAM_STR);
$stmt->bindValue(':cource', $cource, PDO::PARAM_STR);
$stmt->bindValue(':ki', $ki, PDO::PARAM_STR);
$stmt->bindValue(':touitsu_ki', $touitsu_ki, PDO::PARAM_STR);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  header("Location:gram_input.php");
  exit();
}
