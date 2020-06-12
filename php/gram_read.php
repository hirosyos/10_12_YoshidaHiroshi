<?php
session_start();

include("functions.php");
check_session_id();


// DB接続
$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM gram_table';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

//タイトル作成
$title = "";
if ($_SESSION["is_admin"] == 1) {
  $title = "GRAMリスト（一覧画面）[users_id:{$_SESSION["users_id"]}][管理者]";
} else {
  $title = "GRAMリスト（一覧画面）[users_id:{$_SESSION["users_id"]}][一般]";
}

// データ登録処理後
if ($status == false) {
  // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
  $error = $stmt->errorInfo();
  echo json_encode(["error_msg" => "{$error[2]}"]);
  exit();
} else {
  // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
  // fetchAll()関数でSQLで取得したレコードを配列で取得できる
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
  $output = "";
  // <tr><td>deadline</td><td>todo</td><tr>の形になるようにforeachで順番に$outputへデータを追加
  // `.=`は後ろに文字列を追加する，の意味
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td>{$record["id"]}</td>";
    $output .= "<td>{$record["users_id"]}</td>";
    $output .= "<td>{$record["users_password"]}</td>";
    $output .= "<td>{$record["is_admin"]}</td>";
    $output .= "<td>{$record["is_deleted"]}</td>";
    $output .= "<td>{$record["created_at"]}</td>";
    $output .= "<td>{$record["updated_at"]}</td>";
    $output .= "<td>{$record["last_name"]}</td>";
    $output .= "<td>{$record["first_name"]}</td>";
    $output .= "<td>{$record["last_name_kana"]}</td>";
    $output .= "<td>{$record["first_name_kana"]}</td>";
    $output .= "<td>{$record["nick_name"]}</td>";
    $output .= "<td>{$record["users_location"]}</td>";
    $output .= "<td>{$record["cource"]}</td>";
    $output .= "<td>{$record["ki"]}</td>";
    $output .= "<td>{$record["touitsu_ki"]}</td>";

    // edit deleteリンクを追加
    // 編集は管理者または本人しかできない
    if ($_SESSION["is_admin"] == 1) {
      $output .= "<td><a href='gram_edit.php?id={$record["id"]}'>編集</a></td>";
      $output .= "<td><a href='gram_delete.php?id={$record["id"]}'>削除</a></td>";
    } else if ($_SESSION["is_admin"] != 1 && $_SESSION["users_id"] == $record["users_id"]) {
      $output .= "<td><a href='gram_edit.php?id={$record["id"]}'>編集</a></td>";
      $output .= "<td>削除(管理者)</td>";
    } else {
      $output .= "<td>編集(管理者か本人)</td>";
      $output .= "<td>削除(管理者)</td>";
    }
    $output .= "</tr>";
  }
  // $valueの参照を解除する．解除しないと，再度foreachした場合に最初からループしない
  // 今回は以降foreachしないので影響なし
  unset($value);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <title>GRAMリスト（一覧画面</title> -->
  <title><?= $title ?></title>
</head>

<body>
  <fieldset>
    <!-- <legend>GRAMリスト（一覧画面）</legend> -->
    <legend><?= $title ?></legend>
    <a href="gram_input.php">入力画面</a>
    <a href="gram_logout.php">logout</a>
    <table>
      <thead>
        <tr>
          <th>id</th>
          <th>users_id</th>
          <th>users_password</th>
          <th>is_admin</th>
          <th>is_deleted</th>
          <th>created_at</th>
          <th>updated_at</th>
          <th>last_name</th>
          <th>first_name</th>
          <th>last_name_kana</th>
          <th>first_name_kana</th>
          <th>nick_name</th>
          <th>users_location</th>
          <th>cource</th>
          <th>ki</th>
          <th>touitsu_ki</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>
</body>

</html>