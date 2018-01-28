<title>ユーザー登録</title>
<!--タイトルタグ。ブラウザの上部に表示される。-->

<h1>ユーザー登録</h1>
<!--見出しタグ。数字は1～6で、<h1>が最上位の見出し（大見出し）、小さくなるにつれて下位の見出し（小見出し）になる。-->

<form method="POST" action="mission_3-6.php">
<!--method:どのようにデータを送信するか。POSTまたはGET。action:データの送信先-->

<input type="text" name="name" value="" size="" placeholder="名前">
<!--input type属性:1行の入力フィールド。name属性:入力されたデータとセットで送られる名前
value属性:入力フィールドには不要。size属性:入力欄の横幅（文字数）
placeholder属性：入力前のフォームに薄く表示される文字-->

<br>
<!--改行（HTML）。-->

<input type="password" name="password" value="" size="" placeholder="パスワード">

<br>

<input type="submit" name="" value="send">
<!--送信ボタン。value属性:送信ボタンに表示させる文字。-->

</form>



<?php

$pdo = new PDO('データベース名;charset=utf8', 'ユーザー名', 'パスワード');
//PDO関数：PHPからデータベースに接続。('データベースの種類:ホスト;データベース名(;文字コードの指定で文字化け対策)', 'ユーザー名', 'パスワード')

$sql = 'CREATE TABLE userinfo (

	id int (10) AUTO_INCREMENT PRIMARY KEY,
	name varchar (50) NOT NULL,
	password varchar (50) NOT NULL
	
	);';
//テーブルを作成。カラム：ID、名前、パスワード

$stmt = $pdo->query($sql);
//テーブル作成のクエリを実行


$name = htmlspecialchars ($_POST['name'], UTF-8);
$password = htmlspecialchars ($_POST['password'], UTF-8);
//変数の指定と、フォームに入力されたデータ'name''password'を受け取る



if ($name !=null and $password != null){
//$nameと$passwordが空でない場合に処理を実行する

	$sql = 'INSERT INTO userinfo (name, password) VALUES (:name, :password)';
	//INSERT：テーブルに具体的な値を挿入するコマンド。INSERT INTO テーブル名 (値を挿入するカラム名) VALUES (カラムに挿入する値に変数を与える？)

	$stmt = $pdo->prepare($sql);
	//上記$sqlを用意

	$params = array (':name' => "$name", ':password' => "$password");
	//フォームから受け取った値＝挿入する値を配列に格納(変数なのでダブルクォーテーション)

	$stmt->execute($params);
	//用意した$sqlに$paramsを代入して実行
	
	
	echo '<FONT COLOR="BLUE"> ユーザー登録が完了しました。 </FONT>'.'<br>';
	//文字の色を青に
	
	echo '※IDとパスワードは、掲示板へのログイン時に必要となります。'.'<br>';
	echo '<br>';
	echo 'ID:'.$pdo->lastInsertId().'<br>';
	//直前に登録したデータのIDを取得し表示
	
	echo '名前:'.$name.'<br>';
	echo 'パスワード:'.$password;
}

?>