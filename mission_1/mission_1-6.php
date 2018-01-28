<form method="POST" action="mission_1-6.php">
<!--method:どのようにデータを送信するか。POSTまたはGET。action:データの送信先-->

<input type="text" name="comment" value="" size="">
<!--input type属性:1行の入力フィールド。name属性:入力されたデータとセットで送られる名前-->
<!--value属性:入力フィールドには不要。size属性:入力欄の横幅（文字数）-->

<br>
<!--改行（HTML）。-->

<input type="submit" name="" value="送信">
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
\n:改行（PHP）。ダブルクォーテーションでくくらないと、変数やコードとして認識されない。*/

fclose($fp);
//fclose関数：開いていたファイルを閉じる;

}

?>