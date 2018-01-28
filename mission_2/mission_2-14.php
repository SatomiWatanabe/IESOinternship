<?php

$pdo = new PDO('データベース名;charset=utf8', 'ユーザー名', 'パスワード');
//PDO関数：PHPからデータベースに接続。('データベースの種類:ホスト;データベース名(;文字コードの指定で文字化け対策)', 'ユーザー名', 'パスワード')

$sql = 'DELETE FROM testtable WHERE number = :number';
/*DELETE：テーブル内の値を削除するコマンド。DELETE FROM テーブル名 WHERE 削除対象の番号に変数を付与
WHERE：検索。どの値を対象にするか。*/

$stmt = $pdo->prepare($sql);
//$sqlを用意

$params = array (':number' => '2');
//削除したい番号を配列に格納

$stmt->execute($params);
//$sqlに$paramsを代入して実行→指定した番号のレコード（1行分）が削除される。

?>