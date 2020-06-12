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
  <title>GRAMリスト（入力画面）</title>
</head>

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
        users_id: <input type="text" name="users_id">
      </div>
      <div>
        users_password: <input type="text" name="users_password">
      </div>
      <div>
        is_admin: <input type="text" name="is_admin">
      </div>
      <div>
        is_deleted: <input type="text" name="is_deleted">
      </div>
      <div>
        created_at: 自動生成
      </div>
      <div>
        updated_at: 自動生成
      </div>
      <div>
        last_name: <input type="text" name="last_name">
      </div>
      <div>
        first_name: <input type="text" name="first_name">
      </div>
      <div>
        last_name_kana: <input type="text" name="last_name_kana">
      </div>
      <div>
        first_name_kana: <input type="text" name="first_name_kana">
      </div>
      <div>
        nick_name: <input type="text" name="nick_name">
      </div>
      <div>
        users_location: <input type="text" name="users_location">
      </div>
      <div>
        cource: <input type="text" name="cource">
      </div>
      <div>
        ki: <input type="text" name="ki">
      </div>
      <div>
        touitsu_ki: <input type="text" name="touitsu_ki">
      </div>



      <div>
        <button>submit</button>
      </div>
    </fieldset>
  </form>

</body>

</html>