<?php
$filename = 'kadai2.txt';
//echo $filename;

$fp = fopen($filename, 'w');
//fopen�֐��F$filename�Ƃ����t�@�C����w���[�h(=write��������)�ŊJ��

fwrite($fp, 'test');
//fwrite�֐��F�J�����t�@�C����'test'�Ə�������

fclose($fp);
//fclose�֐��F�J���Ă����t�@�C�������

?>