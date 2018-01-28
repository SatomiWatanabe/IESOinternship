<?php

$name = htmlspecialchars ($_POST['name'], UTF-8);
$comment = htmlspecialchars ($_POST['comment'], UTF-8);
$time = date ("Y/m/d H:i:s");
/*変数の指定と、フォームに入力されたデータ'name''comment'を受け取る
date:日時を取得する。Y:年(4桁)、m/d:月日(2桁)、H:時間(24時間表示)、i/s:分秒*/

$data ='<>'.$name.'<>'.$comment.'<>'.$time;
//変数と<>を結合させ、１まとまりのデータにする。

$deletenumber = htmlspecialchars ($_POST['deletenumber'], UTF-8);
//削除対象番号をPOSTで取得。

$editnumber = htmlspecialchars ($_POST['editnumber'], UTF-8);
//編集対象番号を取得

$editednumber = htmlspecialchars ($_POST['editednumber'], UTF-8);
//hiddenからの値受け取り


if ($editnumber !=null){
//$editnumber(編集対象番号)が空でない場合に、処理を実行
	
	$array = file("mission_2-2.txt", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
	//mission_2-2.txtのデータ($data)を1行ずつ配列に格納

	$number = count($array);
	//$arrayの要素数＝投稿番号の取得
	
	$arr = file("mission_2-2_2.txt", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
	//mission_2-2_2.txtのデータ(投稿番号<>名前<>コメント<>時間)を1行ずつ配列に格納
	
	for ($i = 0; $i < $number; $i++) {
	//$arrayの要素数分だけループ処理
	
		$ar = explode("<>", $arr[$i]);
		//$arrを<>で分割し、その一つ一つを配列の要素とする
		
		if ($ar[0] == $editnumber){
		//$ar[0]=投稿番号が$editnumber=編集対象番号と一致した場合に、処理を実行

			$editname = $ar[1];
			$editcomment = $ar[2];
			//編集する名前、コメントを変数とする
		}
	}


}elseif ($name !=null and $comment != null and $editednumber == null){
//$nameと$commentが空でない＋$editnumberが空である場合に処理を実行する

	$filename = 'mission_2-2.txt';
	//echo $filename;
	
	$fp = fopen($filename, 'a');
	//fopen関数：$filenameというファイルをaモード(=追記)で開く;
	
	fwrite($fp, $data."\n");
	/*fwrite関数：開いたファイルに$commentを書き込む;
	\n:改行（PHP）。ダブルクォーテーションでくくらないと、変数やコードとして認識されない。*/
	
	fclose($fp);
	//fclose関数：開いていたファイルを閉じる;


	$array = file("mission_2-2.txt", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
	/*mission_2-2.txtのデータを1行ずつ配列に格納
	FILE_IGNORE_NEW_LINES:各要素の最後に改行文字を追加しないとするパラメータ。
	cf. FILE_SKIP_EMPTY_LINES:空行を読み飛ばす。*/

	$number = count($array);
	//$arrayの要素数を数える
	
	$i = $number-1;
	//変数の指定。配列の「〇番目」=配列の要素数-1;

	$filenames = 'mission_2-2_2.txt';
	//echo mission_2-2_2.txt

	$fp = fopen($filenames, 'a');
	//mission_2-2_2を追記モードで開く

	fwrite($fp, $number.$array[$i]."\n");
	//$arrayのデータを$number=投稿番号と結合させ、ファイルに書き込む＋改行

	fclose($fp);
	//ファイルを閉じる


}elseif ($name !=null and $comment != null and $editednumber != null){
//$name, $comment, $editiednumber(hidden)が空でない場合に処理を実行

	$filenames = 'mission_2-2_2.txt';
	//echo mission_2-2_2.txt
	
	$array = file("mission_2-2.txt", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
	//mission_2-2.txtのデータを1行ずつ配列に格納する
	
	$number = count($array);
	//$arrayの要素数を数える
	
	$arr = file("mission_2-2_2.txt", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
	//mission_2-2_2.txtのデータを1行ずつ配列に格納
	
	$fp = fopen($filenames, 'w');
	//wモードでmission_2-2_2.txtを開く
	
	for ($i = 0; $i < $number; $i++) {
	//$arrayの要素数分だけループ処理
	
		$ar = explode("<>", $arr[$i]);
		//$arrの値をexplode
			
		if ($ar[0] == $editednumber){
		//投稿番号がhiddenからの編集対象番号と一致すれば、処理を実行。
			
			fwrite($fp, $editednumber.$data.'(編集済み)'."\n");
			//編集対象番号=投稿番号と$data=<>名前<>コメント<>時間を結合させたものを書き込む＋改行

		}else{
		//それ以外の場合は、
		
			fwrite($fp, $arr[$i]."\n");
			//mission_2-2_2に元からあった要素をそのまま書き込む
		}
	}
		
	fclose($fp);
	//mission_2-2_2.txtを閉じる
	

}else{
	if ($deletenumber !=null){
	//削除対象番号が空でないときのみ処理を実行。
	//elseifはいくつでも指定できる。

		$array = file("mission_2-2.txt", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);

		$number = count($array);
		
		$arr = file("mission_2-2_2.txt", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);
		
		for ($i = 0; $i < $number; $i++) {
		//要素数分だけループ処理。(処理開始値;処理を繰り返す上限;変化式)
		
			$ar = explode("<>", $arr[$i]);
			//値をexplode
			
			if ($ar[0] == $deletenumber){
			//投稿番号が削除対象番号と一致すれば、処理を実行。
				
				unset ($arr[$i]);
				//mission_2-2_2.txtの配列から、要素を削除。
				
				$arr = array_values ($arr);
				//削除した要素の分、配列のインデックスを詰める。
			}
		}

		$filename = 'mission_2-2_2.txt';
			
		$fp = fopen($filename, 'w');
		//wモード=上書き保存。

		foreach ($arr as $value){
		//foreach (___ as $value):配列の要素を反復処理。各反復において、要素の値が$valueに代入される。
			
			fwrite($fp, $value."\n");
			//mission_2-2_2.txtの要素を1行ずつ書き込む＋改行
		}
		
		fclose($fp);
		//mission_2-2_2.txtを閉じる
	}
}

?>



<title>入力フォームテスト</title>
<!--タイトルタグ。ブラウザの上部に表示される。-->

<h1>入力フォームテスト</h1>
<!--見出しタグ。数字は1～6で、<h1>が最上位の見出し（大見出し）、小さくなるにつれて下位の見出し（小見出し）になる。-->

<form method="POST" action="mission_2-5.php">
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

<input type="submit" name="" value="send">
<!--送信ボタン。value属性:送信ボタンに表示させる文字。-->


<p>
<!--段落(HTML)。自動的に、前後に空行が入る。-->

<form method="POST" action="mission_2-5.php">
<input type="text" name="deletenumber" value="" size="" placeholder="削除対象番号">

<br>

<input type="submit" name="" value="delete">

</p>


<form method="POST" action="mission_2-5.php">
<input type="text" name="editnumber" value="" size="" placeholder="編集対象番号">

<br>

<input type="submit" name="" value="edit">

<br>

</form>



<?php

$arr = file("mission_2-2_2.txt", FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);

$number = count($arr);

for ($i = 0; $i < $number; $i++) {
	
	$ar = explode("<>", $arr[$i]);
	
	echo "<p>";
	
	echo $ar[0];
	echo "<br>";
	echo $ar[1];
	echo "<br>";
	echo $ar[2];
	echo "<br>";
	echo $ar[3];
	
	echo "</p>";

}

?>