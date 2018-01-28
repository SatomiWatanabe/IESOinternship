<?php

$pdo = new PDO('データベース名;charset=utf8', 'ユーザー名', 'パスワード');
//PDO関数：PHPからデータベースに接続。('データベースの種類:ホスト;データベース名(;文字コードの指定で文字化け対策)', 'ユーザー名', 'パスワード')

$sql = 'UPDATE testtable SET name = :name WHERE number = :number';
/*UPDATE：テーブル内の値を編集するコマンド。UPDATE テーブル名 SET 編集する値のカラムに変数を付与 WHERE 編集対象の番号に変数を付与
WHERE：検索。どの値を対象にするか。*/

$stmt = $pdo->prepare($sql);
//$sqlを用意

$params = array (':name' => 'pen', ':number' => '1');
//編集後の値、編集したい番号を配列に格納

$stmt->execute($params);
//$sqlに$paramsを代入して実行

?>