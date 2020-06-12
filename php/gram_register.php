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
        users_id: <input type="text" name="users_id">
      </div>
      <div>
        users_password: <input type="text" name="users_password">
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