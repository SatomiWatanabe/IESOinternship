<?php

$pdo = new PDO('データベース名;charset=utf8', 'ユーザー名', 'パスワード');
//PDO関数：PHPからデータベースに接続。('データベースの種類:ホスト;データベース名(;文字コードの指定で文字化け対策)', 'ユーザー名', 'パスワード')

$sql = 'INSERT INTO testtable (name, comment) VALUES (:name, :comment)';
//INSERT：テーブルに具体的な値を挿入するコマンド。INSERT INTO テーブル名 (値を挿入するカラム名) VALUES (カラムに挿入する値に変数を与える？)

$stmt = $pdo->prepare($sql);
//上記$sqlを用意

$params = array (':name' => 'watanabe', ':comment' => 'good morning');
//挿入する値('watanabe', 'hello world')を配列に格納

$stmt->execute($params);
//用意した$sqlに$paramsを代入して実行

?>