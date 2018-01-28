<title>ログインフォーム</title>
<!--タイトルタグ。ブラウザの上部に表示される。-->

<h1>ログインフォーム</h1>
<!--見出しタグ。数字は1～6で、<h1>が最上位の見出し（大見出し）、小さくなるにつれて下位の見出し（小見出し）になる。-->

<form method="POST" action="mission_3-7.php">
<!--method:どのようにデータを送信するか。POSTまたはGET。action:データの送信先-->

<input type="text" name="id" value="<?php session_start(); echo $_SESSION['id']; ?>" size="" placeholder="ID">
<!--input type属性:1行の入力フィールド。name属性:入力されたデータとセットで送られる名前
value属性:入力フィールドには不要。size属性:入力欄の横幅（文字数）
placeholder属性：入力前のフォームに薄く表示される文字-->

<br>
<!--改行（HTML）。-->

<input type="password" name="loginpassword" value="<?php session_start(); echo $_SESSION['password']; ?>" size="" placeholder="パスワード">

<br>

<input type="submit" name="" value="send">
<!--送信ボタン。value属性:送信ボタンに表示させる文字。-->

</form>



<?php

$pdo = new PDO('データベース名;charset=utf8', 'ユーザー名', 'パスワード');
//PDO関数：PHPからデータベースに接続。('データベースの種類:ホスト;データベース名(;文字コードの指定で文字化け対策)', 'ユーザー名', 'パスワード')


$id = htmlspecialchars ($_POST['id'], UTF-8);
$loginpassword = htmlspecialchars ($_POST['loginpassword'], UTF-8);
//変数の指定と、フォームに入力されたデータ'name''password'を受け取る


if ($id !=null and $loginpassword != null){
//IDとパスワードが空でないときのみ処理を実行。

	$sql = 'SELECT * FROM userinfo';
	//SELECT：テーブルに格納されている値を取得する。SELECT * FROM テーブル名

	$stmt = $pdo->query($sql);
	//$sqlを実行
	
	foreach ($stmt as $re){
	
		if ($re[id] == $id and $re[password] == $loginpassword){
		//テーブル内のIDとパスワードが一致した場合に処理
			
			session_start();
			//セッション開始
			
			$_SESSION['name'] = $re[name];
			/*'name'というセッションに、該当のユーザー名を書き込む。
			セッションはスーパーグローバル変数＝色んなプログラムからアクセス可能。
			デフォルトの有効期限は最終アクセスから24分間で、期限内に再アクセスがあった場合には延長。*/
			
			$_SESSION['id'] = $re[id];
			$_SESSION['password'] = $re[password];
			//次回以降の入力の手間を省くため、入力されたIDとパスワードをセッションに書き込んでおく。
			
			header ('Location: mission_3-7_2.phpのURL');
			//header関数：指定したページに飛ぶ。header ('Location: 移動先のURL')
			
			exit ();
			//別ページに移動するので、ここでの処理は終了
		}
		/*IDまたはパスワードが間違っている場合は
	
		echo '<FONT COLOR="RED"> IDまたはパスワードが間違っています。 </FONT>'.'<br>';
		//エラーメッセージを赤字で表示*/
	}
		

}
/*IDまたはパスワードが空の場合は

echo '<FONT COLOR="RED"> IDまたはパスワードが入力されていません。 </FONT>'.'<br>';
//エラーメッセージを赤字で表示*/

$sql = 'SELECT * FROM userinfo';
//SELECT：テーブルに格納されている値を取得する。SELECT * FROM テーブル名

$stmt = $pdo->query($sql);
//$sqlを実行

foreach ($stmt as $re){

	echo $re[id].',';
	echo $re[name].',';
	echo $re[password].'<br>';
}

?>



