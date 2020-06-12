<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>todoリストログイン画面</title>
</head>

<body>
  <form action="gram_login_act.php" method="POST">
    <fieldset>
      <legend>GRAMログイン画面</legend>
      <div>
        users_id: <input type="text" name="users_id">
      </div>
      <div>
        users_password: <input type="text" name="users_password">
      </div>
      <div>
        <button>Login</button>
      </div>
      <a href="gram_register.php">or register</a>
    </fieldset>
  </form>

</body>

</html>