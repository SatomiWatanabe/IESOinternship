<?php

$pdo = new PDO('データベース名;charset=utf8', 'ユーザー名', 'パスワード');
//PDO関数：PHPからデータベースに接続。('データベースの種類:ホスト;データベース名(;文字コードの指定で文字化け対策)', 'ユーザー名', 'パスワード')

$sql = 'CREATE TABLE testtable (

	number int (10) AUTO_INCREMENT PRIMARY KEY,
	name varchar (50) NOT NULL,
	comment varchar (50) NOT NULL
	
	);';
/*CREATE TABLE：データベースにおいてテーブルを作成するためのコマンド。
CREATE TABLE テーブル名(
	フィールド名 データ型 （長さ）,
	);
	フィールド：テーブルの列（縦）。「カラム」。　データ型：「文字列(varchar)」や「数字(int)」など、どんなデータかを表す
	cf. レコード：テーブルの行（横）。
AUTO_INCREMENT：カラムに自動的に値（整数、1ずつ増加の連番）を割り当てる。*/

$result = $pdo->query($sql);
/*アロー演算子(->)：左辺から右辺を取り出す。初めに接続したデータベースから、作成したテーブルを取り出す。
クエリ：データベースに問い合わせるための文字列。query()=()内の処理を用意＋実行(prepare+execute)*/

?>