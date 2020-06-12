<?php
// 送信データのチェック
// var_dump($_GET);
// exit();

// 関数ファイルの読み込み
session_start();

include("functions.php");
check_session_id();

$id = $_GET["id"];

$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM gram_table WHERE id=:id';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は指定の11レコードを取得
  // fetch()関数でSQLで取得したレコードを取得できる
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GRAM（編集画面）</title>
</head>

<body>
  <form action="gram_update.php" method="POST">
    <fieldset>
      <legend>GRAM（編集画面）</legend>
      <a href="gram_read.php">一覧画面</a>

      <div>
        id: <?= $record["id"] ?>
      </div>
      <div>
        users_id: <input type="text" name="users_id" value="<?= $record["users_id"] ?>">
      </div>
      <div>
        users_password: <input type="text" name="users_password" value="<?= $record["users_password"] ?>">
      </div>
      <div>
        is_admin: <input type="text" name="is_admin" value="<?= $record["is_admin"] ?>">
      </div>
      <div>
        is_deleted: <input type="text" name="is_deleted" value="<?= $record["is_deleted"] ?>">
      </div>
      <div>
        created_at: <?= $record["created_at"] ?>
      </div>
      <div>
        updated_at: <?= $record["updated_at"] ?>
      </div>
      <div>
        last_name: <input type="text" name="last_name" value="<?= $record["last_name"] ?>">
      </div>
      <div>
        first_name: <input type="text" name="first_name" value="<?= $record["first_name"] ?>">
      </div>
      <div>
        last_name_kana: <input type="text" name="last_name_kana" value="<?= $record["last_name_kana"] ?>">
      </div>
      <div>
        first_name_kana: <input type="text" name="first_name_kana" value="<?= $record["first_name_kana"] ?>">
      </div>
      <div>
        nick_name: <input type="text" name="nick_name" value="<?= $record["nick_name"] ?>">
      </div>
      <div>
        users_location: <input type="text" name="users_location" value="<?= $record["users_location"] ?>">
      </div>
      <div>
        cource: <input type="text" name="cource" value="<?= $record["cource"] ?>">
      </div>
      <div>
        ki: <input type="text" name="ki" value="<?= $record["ki"] ?>">
      </div>
      <div>
        touitsu_ki: <input type="text" name="touitsu_ki" value="<?= $record["touitsu_ki"] ?>">
      </div>
      <div>
        <button>submit</button>
      </div>
      <input type="hidden" name="id" value="<?= $record["id"] ?>">
      <input type="hidden" name="created_at" value="<?= $record["created_at"] ?>">
      <input type="hidden" name="updated_at" value="<?= $record["updated_at"] ?>">
    </fieldset>
  </form>

</body>

</html>