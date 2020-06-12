<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>GRAMユーザ登録画面</title>
</head>

<header>
  <h1>GRAM</h1>
</header>

<body>
  <form action="gram_register_act.php" method="POST">
    <fieldset>
      <legend>GRAMユーザ登録画面</legend>
      <div>
        ユーザID: <input type="text" name="users_id">
      </div>
      <div>
        パスワード: <input type="text" name="users_password">
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
        <button>Register</button>
      </div>
      <a href="gram_login.php">or login</a>
    </fieldset>
  </form>

</body>

<footer>
  <p>.</p>
</footer>

</html>