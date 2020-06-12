<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>G'sGram ジーズグラム</title>
    <style>
        .header,
        .footer {
            width: 100%;
            background: #1395E4;
            color: whitesmoke;
            border: 1px solod #000;
            box-sizing: border-box;
            text-align: center;
        }

        main {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            text-align: center;
            flex-direction: column;
        }

        table,
        tr,
        td,
        th {
            text-align: center;
            border: 2px #1395E4 solid;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        form ul {
            list-style: none;
        }
    </style>
</head>

<body>
    <header class="header">
        <h1>G'sGram ジーズグラム</h1>
        <button id="readListBtn">名簿読み出し</button>
    </header>
    <main>


        <table id='gsTable'>
            <tr>
                <th>check</th>
                <th>苗字</th>
                <th>名前</th>
                <th>ミョウジ</th>
                <th>ナマエ</th>
                <th>ニックネーム</th>
                <th>東京/福岡</th>
                <th>DIV/LAB</th>
                <th>期</th>
                <th>統一期</th>
            </tr>

        </table>

        <button id="readGsGram">ジーズグラム呼び出し</button>
        <table id='gsGramTable'></table>
    </main>
    <footer class="footer">
        <p>統一期とは東京DEVの期を基準とし、東京LABは7期、福岡DEVは10期、福岡LABは13期足し合わせたものである</p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>

        //東京DEVを基準とした時の差分
        const gsDevLabGap =
        {
            tokyoDev: 0,
            tokyoLav: 7,
            fukuokaDev: 10,
            fukuokaLav: 13
        };

        //名簿
        let gsMemberList = [
            {
                lastName: 'AAA',
                lastNameKana: 'エー',
                firstName: '000',
                firstNameKana: 'ゼロ',
                nickName: 'アルファ',
                gsPlace: '東京',
                gsDevLabKind: 'DEV',
                gsDevLavNo: 1,
                gsDevLavUniNo: 0,
                gsGram: ['／', '契約T', 'ー', 'ー', '生徒', '生徒', 'ー', 'ー']
            },
            {
                lastName: 'BBB',
                lastNameKana: 'ビー',
                firstName: '111',
                firstNameKana: 'イチ',
                nickName: 'ブラボー',
                gsPlace: '東京',
                gsDevLabKind: 'LAB',
                gsDevLavNo: 1,
                gsDevLavUniNo: 0,
                gsGram: ['雇用主', '／', 'ー', 'ー', '生徒', '生徒', 'ー', 'ー']
            },
            {
                lastName: 'CCC',
                lastNameKana: 'シー',
                firstName: '222',
                firstNameKana: 'ニ',
                nickName: 'チャーリー',
                gsPlace: '福岡',
                gsDevLabKind: 'DEV',
                gsDevLavNo: 1,
                gsDevLavUniNo: 0,
                gsGram: ['ー', 'ー', '／', '契約T', 'ー', 'ー', '生徒', '生徒']
            },
            {
                lastName: 'DDD',
                lastNameKana: 'ディー',
                firstName: '333',
                firstNameKana: 'サン',
                nickName: 'デルタ',
                gsPlace: '福岡',
                gsDevLabKind: 'LAB',
                gsDevLavNo: 1,
                gsDevLavUniNo: 0,
                gsGram: ['ー', 'ー', '雇用主', '／', 'ー', 'ー', '生徒', '生徒']
            },
            {
                lastName: 'EEE',
                lastNameKana: 'イー',
                firstName: '444',
                firstNameKana: 'ヨン',
                nickName: 'エコー',
                gsPlace: '東京',
                gsDevLabKind: 'DEV',
                gsDevLavNo: 16,
                gsDevLavUniNo: 0,
                gsGram: ['先生', 'T', 'ー', 'ー', '／', 'ー', 'ー', 'ー']
            },
            {
                lastName: 'FFF',
                lastNameKana: 'エフ',
                firstName: '555',
                firstNameKana: 'ゴ',
                nickName: 'フォックス',
                gsPlace: '東京',
                gsDevLabKind: 'LAB',
                gsDevLavNo: 9,
                gsDevLavUniNo: 0,
                gsGram: ['先生', 'T', 'ー', 'ー', 'ー', '／', 'ー', 'ー']
            },
            {
                lastName: 'GGG',
                lastNameKana: 'ジー',
                firstName: '666',
                firstNameKana: 'ロク',
                nickName: 'ゴルフ',
                gsPlace: '福岡',
                gsDevLabKind: 'DEV',
                gsDevLavNo: 6,
                gsDevLavUniNo: 0,
                gsGram: ['ー', 'ー', '先生', 'T', 'ー', 'ー', '／', 'ー']
            },
            {
                lastName: 'HHH',
                lastNameKana: 'エイチ',
                firstName: '777',
                firstNameKana: 'ナナ',
                nickName: 'ホテル',
                gsPlace: '福岡',
                gsDevLabKind: 'LAB',
                gsDevLavNo: 3,
                gsDevLavUniNo: 0,
                gsGram: ['ー', 'ー', '先生', 'T', 'ー', 'ー', 'ー', '／']
            }
        ]

        //
        //JQueryの始まり
        //
        $(function () {


            //
            // 名簿読み出しクリック時
            //
            $('#readListBtn').on('click', function () {
                let createList = '';
                createList = '<tr>';
                createList += '<th>check</th>';
                createList += '<th>苗字</th>';
                createList += '<th>名前</th>';
                createList += '<th>ミョウジ</th>';
                createList += '<th>ナマエ</th>';
                createList += '<th>ニックネーム</th>';
                createList += '<th>東京/福岡</th>';
                createList += '<th>DIV/LAB</th>';
                createList += '<th>期</th>';
                createList += '<th>統一期</th>';
                createList += '</tr>';
                for (let i = 0; i < gsMemberList.length; i++) {
                    createList += '<tr>';
                    createList += '<td><input type="checkbox" class="checks" value=' + i + '></td>';
                    createList += '<td>' + gsMemberList[i].lastName + '</td>';
                    createList += '<td>' + gsMemberList[i].firstName + '</td>';
                    createList += '<td>' + gsMemberList[i].lastNameKana + '</td>';
                    createList += '<td>' + gsMemberList[i].firstNameKana + '</td>';
                    createList += '<td>' + gsMemberList[i].nickName + '</td>';
                    createList += '<td>' + gsMemberList[i].gsPlace + '</td>';
                    createList += '<td>' + gsMemberList[i].gsDevLabKind + '</td>';
                    createList += '<td>' + gsMemberList[i].gsDevLavNo + '</td>';
                    //統一期を求める
                    let gsDevLavUniNo = 0;
                    if (gsMemberList[i].gsPlace == '福岡' && gsMemberList[i].gsDevLabKind == 'LAB') {
                        //福岡LABは東京DEVに対して13期遅れ
                        gsMemberList[i].gsDevLavUniNo = Number(gsMemberList[i].gsDevLavNo) + 13;
                    } else if (gsMemberList[i].gsPlace == '福岡' && gsMemberList[i].gsDevLabKind == 'DEV') {
                        //福岡DEVは東京DEVに対して10期遅れ
                        gsMemberList[i].gsDevLavUniNo = Number(gsMemberList[i].gsDevLavNo) + 10;
                    } else if (gsMemberList[i].gsPlace == '東京' && gsMemberList[i].gsDevLabKind == 'LAB') {
                        //東京LABは東京DEVに対して7期遅れ
                        gsMemberList[i].gsDevLavUniNo = Number(gsMemberList[i].gsDevLavNo) + 7;
                    } else {
                        //東京DEVからスタートしたので統一期は東京DEV基準
                        gsMemberList[i].gsDevLavUniNo = Number(gsMemberList[i].gsDevLavNo)
                    }
                    createList += '<td>' + gsMemberList[i].gsDevLavUniNo + '</td>';
                    createList += '</tr>';
                }
                // 文字列を#gsTable
                $('#gsTable').html(createList)

            });


            //
            // ジーズグラム読み出しクリック時
            //
            $('#readGsGram').on('click', function () {
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
                        }
                        else if (gsMemberList[gsMemberListNo[i]].gsDevLavUniNo < gsMemberList[gsMemberListNo[j]].gsDevLavUniNo) {
                            //自分の方が先輩 相手の方が後輩
                            Sa = gsMemberList[gsMemberListNo[j]].gsDevLavUniNo - gsMemberList[gsMemberListNo[i]].gsDevLavUniNo + '期後輩';
                        }
                        else if (i == j) {
                            //自分
                            Sa = '／';
                        }
                        else {
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