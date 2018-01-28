<?php

$pdo = new PDO('データベース名;charset=utf8', 'ユーザー名', 'パスワード');
//PDO関数：PHPからデータベースに接続。('データベースの種類:ホスト;データベース名(;文字コードの指定で文字化け対策)', 'ユーザー名', 'パスワード')

$sql = 'SELECT * FROM testtable';
//SELECT：テーブルに格納されている値を取得する。SELECT * FROM テーブル名

$stmt = $pdo->query($sql);
//$sqlを実行

foreach ($stmt as $re){

	echo $re[number].',';
	echo $re[name].',';
	echo $re[comment].'<br>';
}
//取得した値を「,」で区切って1つずつ表示させる。インデックスはカラム名。

?>