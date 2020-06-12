<?php
session_start();

include("functions.php");
check_session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>GRAMリスト（入力画面）</title>
</head>

<header>
  <h1>GRAM</h1>
</header>

<body>
  <form action="gram_create.php" method="POST">
    <fieldset>
      <legend>GRAMリスト（入力画面）</legend>
      <a href="gram_read.php">一覧画面</a>
      <a href="gram_logout.php">logout</a>

      <div>
        id: 自動生成
      </div>
      <div>
        ユーザID: <input type="text" name="users_id">
      </div>
      <div>
        パスワード: <input type="text" name="users_password">
      </div>
      <div>
        管理者権限: <input type="text" name="is_admin">
      </div>
      <div>
        削除: <input type="text" name="is_deleted">
      </div>
      <div>
        作成日時: 自動生成
      </div>
      <div>
        更新日時: 自動生成
      </div>
      <div>
        名字: <input type="text" name="last_name">
      </div>
      <div>
        名前: <input type="text" name="first_name">
      </div>
      <div>
        ミョウジ: <input type="text" name="last_name_kana">
      </div>
      <div>
        ナマエ: <input type="text" name="first_name_kana">
      </div>
      <div>
        ニックネーム: <input type="text" name="nick_name">
      </div>
      <div>
        場所: <input type="text" name="users_location">
      </div>
      <div>
        コース: <input type="text" name="cource">
      </div>
      <div>
        期: <input type="text" name="ki">
      </div>
      <div>
        統一期: <input type="text" name="touitsu_ki">
      </div>



      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

<footer>
  <p>.</p>
</footer>

</html>