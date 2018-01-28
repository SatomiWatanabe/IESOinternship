<?php
$filename = 'kadai2.txt';
//echo $filename;

$fp = fopen($filename, 'w');
//fopen関数：$filenameというファイルをwモード(=write書き込み)で開く

fwrite($fp, 'test');
//fwrite関数：開いたファイルに'test'と書き込む

fclose($fp);
//fclose関数：開いていたファイルを閉じる

?>