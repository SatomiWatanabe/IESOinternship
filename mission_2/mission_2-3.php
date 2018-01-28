<title>アイスクリーム日記</title>
<!--タイトルタグ。ブラウザの上部に表示される。-->

<h1>アイスクリーム日記</h1>
<!--見出しタグ。数字は1～6で、<h1>が最上位の見出し（大見出し）、小さくなるにつれて下位の見出し（小見出し）になる。-->

<form method="POST" action="mission_2-3.php">
<!--method:どのようにデータを送信するか。POSTまたはGET。action:データの送信先-->

<input type="text" name="name" value="" size="" placeholder="名前">
<!--input type属性:1行の入力フィールド。name属性:入力されたデータとセットで送られる名前
value属性:入力フィールドには不要。size属性:入力欄の横幅（文字数）
placeholder属性：入力前のフォームに薄く表示される文字-->

<br>
<!--改行（HTML）。-->

<textarea name="comment" cols="50" rows="5" value="" size="" placeholder="コメント"></textarea>
<!--textarea:複数行の入力フィールド。colsで横幅（文字数）、rowsで行数を指定する。-->

<br>

<input type="submit" name="" value="send">
<!--送信ボタン。value属性:送信ボタンに表示させる文字。-->

</form>


<?php

$name = htmlspecialchars ($_POST['name'], UTF-8);
$comment = htmlspecialchars ($_POST['comment'], UTF-8);
$time = date ("Y/m/d H:i:s");
/*変数の指定と、フォームに入力されたデータ'name''comment'を受け取る;
date:日時を取得する。Y:年(4桁)、m/d:月日(2桁)、H:時間(24時間表示)、i/s:分秒*/

$data ='<>'.$name.'<>'.$comment.'<>'.$time;
//変数と<>を結合させ、１まとまりのデータにする。;

if ($name !=null and $comment != null){
/*if文：$nameと$commentがnull（空）ではなければ、{}内の処理を実行する;
!=:「≠」を表す。「＝」は==で表す。;*/

	$filename = 'mission_2-2.txt';
	//echo $filename;
	
	$fp = fopen($filename, 'a');
	//fopen関数：$filenameというファイルをaモード(=追記)で開く;
	
	fwrite($fp, $data."\n");
	/*fwrite関数：開いたファイルに$commentを書き込む;
	\n:改行（PHP）。ダブルクォーテーションでくくらないと、変数やコードとして認識されない。*/
	
	fclose($fp);
	//fclose関数：開いていたファイルを閉じる;


	$array = file("mission_2-2.txt", FILE_IGNORE_NEW_LINES);
	/*FILE_IGNORE_NEW_LINES:各要素の最後に改行文字を追加しないとするパラメータ。;
	cf. FILE_SKIP_EMPTY_LINES:空行を読み飛ばす。*/

	$number = count($array);
	
	$i = $number-1;
	//変数の指定。配列の「〇番目」=配列の要素数-1;

	$filenames = 'mission_2-2_2.txt';

	$fp = fopen($filenames, 'a');

	fwrite($fp, $number.$array[$i]."\n");

	fclose($fp);

}


$arr = file("mission_2-2_2.txt", FILE_IGNORE_NEW_LINES);

$i = 0;

while ($i < $number) {
	
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
	
	$i++;

}

?>