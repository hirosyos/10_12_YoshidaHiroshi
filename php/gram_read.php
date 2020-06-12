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
  $title = "GRAMリスト（一覧画面）[ユーザID:{$_SESSION["users_id"]}][管理者]";
} else {
  $title = "GRAMリスト（一覧画面）[ユーザID:{$_SESSION["users_id"]}][一般]";
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
  $valCnt = 1;
  foreach ($result as $record) {
    $output .= "<tr>";
    $output .= "<td><input type='checkbox' class='checks' value='{$valCnt}'></td>";
    $output .= "<td>{$record["id"]}</td>";
    $output .= "<td>{$record["users_id"]}</td>";
    $output .= "<td>{$record["last_name"]}</td>";
    $output .= "<td>{$record["first_name"]}</td>";
    $output .= "<td>{$record["last_name_kana"]}</td>";
    $output .= "<td>{$record["first_name_kana"]}</td>";
    $output .= "<td>{$record["nick_name"]}</td>";
    $output .= "<td>{$record["users_location"]}</td>";
    $output .= "<td>{$record["cource"]}</td>";
    $output .= "<td>{$record["ki"]}</td>";
    $output .= "<td>{$record["touitsu_ki"]}</td>";
    if ($_SESSION["is_admin"] == 1) {
      $output .= "<td>{$record["users_password"]}</td>";
      $output .= "<td>{$record["is_admin"]}</td>";
      $output .= "<td>{$record["is_deleted"]}</td>";
      $output .= "<td>{$record["created_at"]}</td>";
      $output .= "<td>{$record["updated_at"]}</td>";
    }

    // edit deleteリンクを追加
    // 編集/削除は管理者または本人しかできない
    if ($_SESSION["is_admin"] == 1) {
      $output .= "<td><a href='gram_edit.php?id={$record["id"]}'>編集</a></td>";
      $output .= "<td><a href='gram_delete.php?id={$record["id"]}'>削除</a></td>";
    } else if ($_SESSION["is_admin"] != 1 && $_SESSION["users_id"] == $record["users_id"]) {
      $output .= "<td><a href='gram_edit.php?id={$record["id"]}'>編集</a></td>";
      $output .= "<td><a href='gram_delete.php?id={$record["id"]}'>削除</a></td>";
    } else {
      $output .= "<td>-</td>";
      $output .= "<td>-</td>";
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
  <link rel="stylesheet" href="../css/style.css">

  <!-- <title>GRAMリスト（一覧画面</title> -->
  <title><?= $title ?></title>
</head>

<header>
  <h1>GRAM</h1>
</header>

<body>
  <fieldset>
    <!-- <legend>GRAMリスト（一覧画面）</legend> -->
    <legend><?= $title ?></legend>
    <a href="gram_input.php">入力画面</a>
    <a href="gram_logout.php">logout</a>
    <table>
      <thead>
        <tr>
          <th>CHECK</th>
          <th>ID</th>
          <th>ユーザID</th>
          <th>名字</th>
          <th>名前</th>
          <th>ミョウジ</th>
          <th>ナマエ</th>
          <th>ニックネーム</th>
          <th>場所</th>
          <th>コース</th>
          <th>期</th>
          <th>統一期</th>
          <?php if ($_SESSION["is_admin"] == 1) {
            echo ("<th>パスワード</th>");
            echo ("<th>管理者権限</th>");
            echo ("<th>削除</th>");
            echo ("<th>作成日時</th>");
            echo ("<th>更新日時</th>");
          } ?>
          <th>編集</th>
          <th>削除</th>
        </tr>
      </thead>
      <tbody>
        <!-- ここに<tr><td>deadline</td><td>todo</td><tr>の形でデータが入る -->
        <?= $output ?>
      </tbody>
    </table>
  </fieldset>

  <button id="readGsGram">OPEN GRAM</button>
  <table id='gsGramTable'></table>

  <footer>
    <p>統一期とは東京DEVの期を基準とし、東京LABは7期、福岡DEVは10期、福岡LABは13期足し合わせたものである</p>
  </footer>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script>
    //東京DEVを基準とした時の差分
    const gsDevLabGap = {
      tokyoDev: 0,
      tokyoLav: 7,
      fukuokaDev: 10,
      fukuokaLav: 13
    };

    //
    //JQueryの始まり
    //
    $(function() {

      //
      // 名簿読み出しクリック時
      //
      // $('#readListBtn').on('click', function() {
      //   let createList = '';
      //   createList = '<tr>';
      //   createList += '<th>check</th>';
      //   createList += '<th>苗字</th>';
      //   createList += '<th>名前</th>';
      //   createList += '<th>ミョウジ</th>';
      //   createList += '<th>ナマエ</th>';
      //   createList += '<th>ニックネーム</th>';
      //   createList += '<th>東京/福岡</th>';
      //   createList += '<th>DIV/LAB</th>';
      //   createList += '<th>期</th>';
      //   createList += '<th>統一期</th>';
      //   createList += '</tr>';
      //   for (let i = 0; i < gsMemberList.length; i++) {
      //     createList += '<tr>';
      //     createList += '<td><input type="checkbox" class="checks" value=' + i + '></td>';
      //     createList += '<td>' + gsMemberList[i].lastName + '</td>';
      //     createList += '<td>' + gsMemberList[i].firstName + '</td>';
      //     createList += '<td>' + gsMemberList[i].lastNameKana + '</td>';
      //     createList += '<td>' + gsMemberList[i].firstNameKana + '</td>';
      //     createList += '<td>' + gsMemberList[i].nickName + '</td>';
      //     createList += '<td>' + gsMemberList[i].gsPlace + '</td>';
      //     createList += '<td>' + gsMemberList[i].gsDevLabKind + '</td>';
      //     createList += '<td>' + gsMemberList[i].gsDevLavNo + '</td>';
      //     //統一期を求める
      //     let gsDevLavUniNo = 0;
      //     if (gsMemberList[i].gsPlace == '福岡' && gsMemberList[i].gsDevLabKind == 'LAB') {
      //       //福岡LABは東京DEVに対して13期遅れ
      //       gsMemberList[i].gsDevLavUniNo = Number(gsMemberList[i].gsDevLavNo) + 13;
      //     } else if (gsMemberList[i].gsPlace == '福岡' && gsMemberList[i].gsDevLabKind == 'DEV') {
      //       //福岡DEVは東京DEVに対して10期遅れ
      //       gsMemberList[i].gsDevLavUniNo = Number(gsMemberList[i].gsDevLavNo) + 10;
      //     } else if (gsMemberList[i].gsPlace == '東京' && gsMemberList[i].gsDevLabKind == 'LAB') {
      //       //東京LABは東京DEVに対して7期遅れ
      //       gsMemberList[i].gsDevLavUniNo = Number(gsMemberList[i].gsDevLavNo) + 7;
      //     } else {
      //       //東京DEVからスタートしたので統一期は東京DEV基準
      //       gsMemberList[i].gsDevLavUniNo = Number(gsMemberList[i].gsDevLavNo)
      //     }
      //     createList += '<td>' + gsMemberList[i].gsDevLavUniNo + '</td>';
      //     createList += '</tr>';
      //   }
      //   // 文字列を#gsTable
      //   $('#gsTable').html(createList)

      // });


      //
      // ジーズグラム読み出しクリック時
      //
      $('#readGsGram').on('click', function() {
        let checks = document.getElementsByClassName('checks');
        let str = '';
        // 誰がジーズグラム対象かをリストアップする
        let gsMemberListNo = [];
        for (let i = 0; i < gsMemberList.length; i++) {
          if (checks[i].checked === true) {
            gsMemberListNo.push(i);
          }
        }

        //一番上の行はそれぞれの行の人物に対する人物を配置
        let createList = '';
        createList = '<tr>';
        createList += '<th></th>';
        for (let i = 0; i < gsMemberListNo.length; i++) {
          createList += '<th>' + gsMemberList[gsMemberListNo[i]].nickName + '</th>';
        }
        createList += '</tr>';

        //2番目以降の行でジーズグラムを構成
        for (let i = 0; i < gsMemberListNo.length; i++) {
          createList += '<tr>';
          createList += '<td>' + gsMemberList[gsMemberListNo[i]].nickName + '</td>';

          for (let j = 0; j < gsMemberListNo.length; j++) {
            let Sa;
            createList += '<td>'
            if (gsMemberList[gsMemberListNo[i]].gsDevLavUniNo > gsMemberList[gsMemberListNo[j]].gsDevLavUniNo) {
              //自分の方が後輩 相手の方が先輩
              Sa = gsMemberList[gsMemberListNo[i]].gsDevLavUniNo - gsMemberList[gsMemberListNo[j]].gsDevLavUniNo + '期先輩';
            } else if (gsMemberList[gsMemberListNo[i]].gsDevLavUniNo < gsMemberList[gsMemberListNo[j]].gsDevLavUniNo) {
              //自分の方が先輩 相手の方が後輩
              Sa = gsMemberList[gsMemberListNo[j]].gsDevLavUniNo - gsMemberList[gsMemberListNo[i]].gsDevLavUniNo + '期後輩';
            } else if (i == j) {
              //自分
              Sa = '／';
            } else {
              //同期
              Sa = '同期';
            }
            createList += '<p>' + Sa + '</p>';
            createList += '<p>' + gsMemberList[gsMemberListNo[i]].gsGram[gsMemberListNo[j]] + '</p>';
            createList += '</td>'
          }

          createList += '</tr>';
        }
        // 文字列を#gsTable
        $('#gsGramTable').html(createList)


      });


    });
  </script>

</body>

</html>