<?php
$comment=$_POST['comment'];
//変数$を指定。''はname属性。ここでphpがデータを受け取る;
echo $comment;
//echo:変数$commentをブラウザで表示;
?>

<form method="POST" action="mission_1-4.php">
<!--method:どのようにデータを送信するか。POSTまたはGET。action:データの送信先-->

<input type="text" name="comment" value="" size="">
<!--input type属性:1行の入力フィールド。name属性:入力されたデータとセットで送られる名前-->
<!--value属性:入力フィールドには不要。size属性:入力欄の横幅（文字数）-->

<input type="submit" name="" value="送信">
<!--送信ボタン。value属性:送信ボタンに表示させる文字。-->

</form>