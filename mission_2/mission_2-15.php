<?php

$pdo = new PDO('データベース名;charset=utf8', 'ユーザー名', 'パスワード');
//PDO関数：PHPからデータベースに接続。('データベースの種類:ホスト;データベース名(;文字コードの指定で文字化け対策)', 'ユーザー名', 'パスワード')

$sql = 'CREATE TABLE chatroom (

	number int (10) AUTO_INCREMENT PRIMARY KEY,
	name varchar (50) NOT NULL,
	comment varchar (50) NOT NULL,
	time varchar (50) NOT NULL,
	password varchar (50) NOT NULL
	
	);';
//テーブルを作成。カラム：番号、名前、コメント、時間、パスワード

$stmt = $pdo->query($sql);
//テーブル作成のクエリを実行


$name = htmlspecialchars ($_POST['name'], UTF-8);
$comment = htmlspecialchars ($_POST['comment'], UTF-8);
$password = htmlspecialchars ($_POST['password'], UTF-8);
$time = date ("Y/m/d H:i:s");
/*変数の指定と、フォームに入力されたデータ'name''comment''password'を受け取る
date:日時を取得する。Y:年(4桁)、m/d:月日(2桁)、H:時間(24時間表示)、i/s:分秒*/

$deletenumber = htmlspecialchars ($_POST['deletenumber'], UTF-8);
$deletepassword = htmlspecialchars ($_POST['deletepassword'], UTF-8);
//削除対象番号とパスワードをPOSTで取得。

$editnumber = htmlspecialchars ($_POST['editnumber'], UTF-8);
//編集対象番号を取得

$editednumber = htmlspecialchars ($_POST['editednumber'], UTF-8);
//hiddenからの値受け取り



if ($editnumber !=null){
//【編集】$editnumber(編集対象番号)が空でない場合に、処理を実行
	
	$sql = 'SELECT * FROM chatroom';
		//SELECT：テーブルに格納されている値を取得する。SELECT * FROM テーブル名

	$stmt = $pdo->query($sql);
	//$sqlを実行
	
	foreach ($stmt as $re){
	
		if ($re[number] == $editnumber){
		//テーブル内の番号と編集対象番号が一致した場合に処理
		
			$editname = $re[name];
			$editcomment = $re[comment];
			//編集する名前、コメントを変数とする
		}
	}


}elseif ($name !=null and $comment != null and $password != null and $editednumber == null){
//【投稿】$nameと$commentと$passwordが空でない＋hiddenの$editednumberが空である場合に処理を実行する

	$sql = 'INSERT INTO chatroom (name, comment, time, password) VALUES (:name, :comment, :time, :password)';
	//INSERT：テーブルに具体的な値を挿入するコマンド。INSERT INTO テーブル名 (値を挿入するカラム名) VALUES (カラムに挿入する値に変数を与える？)

	$stmt = $pdo->prepare($sql);
	//上記$sqlを用意

	$params = array (':name' => "$name", ':comment' => "$comment", ':time' =>  "$time", ':password' => "$password");
	//フォームから受け取った値＝挿入する値を配列に格納(変数なのでダブルクォーテーション)

	$stmt->execute($params);
	//用意した$sqlに$paramsを代入して実行


}elseif ($name !=null and $comment != null and $password != null and $editednumber != null){
//【編集後の再投稿】$name, $comment, $password, $editiednumber(hidden)が空でない場合に処理を実行
//elseifはいくつでも指定できる。

	$sql = 'SELECT * FROM chatroom';
		//SELECT：テーブルに格納されている値を取得する。SELECT * FROM テーブル名

	$stmt = $pdo->query($sql);
	//$sqlを実行
	
	foreach ($stmt as $re){
		
		if ($re[number] == $editednumber and $re[password] == $password){
		
			$sql = 'UPDATE chatroom SET name = :name, comment = :comment, time = :time WHERE number = :number';
			/*UPDATE：テーブル内の値を編集するコマンド。UPDATE テーブル名 SET 編集する値のカラムに変数を付与 WHERE 編集対象の番号に変数を付与
			WHERE：検索。どの値を対象にするか。*/

			$stmt = $pdo->prepare($sql);
			//$sqlを用意

			$params = array (':name' => "$name", ':comment' => "$comment", ':time' => "$time".'(編集済み)', ':number' => "$editednumber");
			//編集後の値、編集したい番号を配列に格納

			$stmt->execute($params);
			//$sqlに$paramsを代入して実行
		}
	}


}else{
	if ($deletenumber !=null and $deletepassword != null){
	//【削除】削除対象番号とパスワードが空でないときのみ処理を実行。

		$sql = 'SELECT * FROM chatroom';
		//SELECT：テーブルに格納されている値を取得する。SELECT * FROM テーブル名

		$stmt = $pdo->query($sql);
		//$sqlを実行

		foreach ($stmt as $re){
		
			if ($re[number] == $deletenumber and $re[password] == $deletepassword){
			//既存の投稿番号・パスワードと、フォームから受け取った削除対象番号・パスワードが一致した場合に処理
			
				$sql = 'DELETE FROM chatroom WHERE number = :number';
				/*DELETE：テーブル内の値を削除するコマンド。DELETE FROM テーブル名 WHERE 削除対象の番号に変数を付与
				WHERE：検索。どの値を対象にするか。*/

				$stmt = $pdo->prepare($sql);
				//$sqlを用意
				
				$params = array (':number' => "$deletenumber");
				//削除したい番号を配列に格納

				$stmt->execute($params);
				//$sqlに$paramsを代入して実行→指定した番号のレコード（1行分）が削除される。
			}
		}
		
	}
}

?>



<title>入力フォームテスト (MySQL)</title>
<!--タイトルタグ。ブラウザの上部に表示される。-->

<h1>入力フォームテスト (MySQL)</h1>
<!--見出しタグ。数字は1～6で、<h1>が最上位の見出し（大見出し）、小さくなるにつれて下位の見出し（小見出し）になる。-->

<form method="POST" action="mission_2-15.php">
<!--method:どのようにデータを送信するか。POSTまたはGET。action:データの送信先-->

<input type="hidden" name="editednumber" value="<?php echo $editnumber; ?>">

<input type="text" name="name" value="<?php echo $editname; ?>" size="" placeholder="名前">
<!--input type属性:1行の入力フィールド。name属性:入力されたデータとセットで送られる名前
value属性:入力フィールドには不要。size属性:入力欄の横幅（文字数）
placeholder属性：入力前のフォームに薄く表示される文字-->

<br>
<!--改行（HTML）。-->

<input type="text" name="comment" value="<?php echo $editcomment; ?>" size="" placeholder="コメント">
<!--textareaにはvalue属性が無い。-->

<br>

<input type="password" name="password" value="" size="" placeholder="パスワード">

<br>

<input type="submit" name="" value="send">
<!--送信ボタン。value属性:送信ボタンに表示させる文字。-->


<p>
<!--段落(HTML)。自動的に、前後に空行が入る。-->

<form method="POST" action="mission_2-15.php">
<input type="text" name="deletenumber" value="" size="" placeholder="削除対象番号">

<br>

<input type="password" name="deletepassword" value="" size="" placeholder="パスワード">

<br>

<input type="submit" name="" value="delete">

</p>


<form method="POST" action="mission_2-15.php">
<input type="text" name="editnumber" value="" size="" placeholder="編集対象番号">

<br>

<input type="submit" name="" value="edit">

<br>

</form>



<?php

$pdo = new PDO('データベース名;charset=utf8', 'ユーザー名', 'パスワード');
//PDO関数でPHPからデータベースに接続

$sql = 'SELECT * FROM chatroom';
//SELECT：テーブルに格納されている値を取得する。SELECT * FROM テーブル名

$stmt = $pdo->query($sql);
//$sqlを実行

foreach ($stmt as $re){

	echo "<p>";
	
	echo $re[number].'<br>';
	echo $re[name].'<br>';
	echo $re[comment].'<br>';
	echo $re[time].'<br>';
	
	echo "</p>";
}
//取得した値を1つずつ表示させる。インデックスはカラム名。

?>