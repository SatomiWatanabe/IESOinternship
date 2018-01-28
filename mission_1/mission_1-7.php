<form method="POST" action="mission_1-7.php">
<!--method:どのようにデータを送信するか。POSTまたはGET。action:データの送信先-->

<input type="text" name="comment" value="" size="">
<!--input type属性:1行の入力フィールド。name属性:入力されたデータとセットで送られる名前-->
<!--value属性:入力フィールドには不要。size属性:入力欄の横幅（文字数）-->

<br>
<!--改行（HTML）。-->

<input type="submit" name="" value="send">
<!--送信ボタン。value属性:送信ボタンに表示させる文字。-->

</form>


<?php

$comment=$_POST['comment'];
//変数$commentの指定と、フォームに入力されたデータ'comment'を受け取る;

if ($comment != null){
/*if文：$commentがnull（空）ではなければ、{}内の処理を実行する;
!=:比較演算子（ある2つの値を比較するもの）。「≠」を表す。「＝」は==で表す。;*/

$filename = 'mission_1-6.txt';
//echo $filename;

$fp = fopen($filename, 'a');
//fopen関数：$filenameというファイルをaモード(=追記)で開く;

fwrite($fp, $comment."\n");
/*fwrite関数：開いたファイルに$commentを書き込む;
\n:改行（PHP）。ダブルクォーテーションでくくらないと、変数やコードとして認識されない。
文字列を結合させるときはピリオドを使う。*/

fclose($fp);
//fclose関数：開いていたファイルを閉じる;

}


$array = file ("mission_1-6.txt");
/* file(""):読み込んだファイル""の中身を配列に格納する。＝配列が作成される。
mission_1-6.txtから作成した配列を、変数$arrayとして指定する。
cf. print_r ():配列の中身（要素1つ1つ）を表示させる。*/

$i = 0;
//ループ処理の開始が配列の何番目の要素かを指定。（0=1番目、1=2番目、、、）;

while ($i < count ($array)) {
/* while関数：（条件式）になるまで｛処理｝を繰り返す。
count関数：($変数)の要素を数える。
条件式：$iは要素数-1なので、「=<」にはしない。*/

echo $array [$i];
//echo $arrayの中の$i番目の要素

echo "<br>";
//HTML上での改行

$i++;
/*変化式：1つの要素について上記の処理を終えたら、次の要素$(i+1)に移って下さい。
++:加算子。$a++=$aを返し、$aに1を加える。*/

}

?>