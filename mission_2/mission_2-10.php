<?php

$pdo = new PDO('データベース名;charset=utf8', 'ユーザー名', 'パスワード');
//PDO関数：PHPからデータベースに接続。('データベースの種類:ホスト;データベース名(;文字コードの指定で文字化け対策)', 'ユーザー名', 'パスワード')

$stmt = $pdo->query('SHOW CREATE TABLE testtable');
//SHOW CREATE TABLE：テーブルの中身（項目名など）を表示させるためのコマンド。SHOW CREATE TABLE テーブル名

foreach ($stmt as $re){

	print_r($re);
}
//テーブル名およびその中身（項目名など）を配列の要素として表示させる。

?>