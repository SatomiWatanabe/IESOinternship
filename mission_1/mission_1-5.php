<form method="POST" action="mission_1-5.php">
<!--method:�ǂ̂悤�Ƀf�[�^�𑗐M���邩�BPOST�܂���GET�Baction:�f�[�^�̑��M��-->

<input type="text" name="comment" value="" size="">
<!--input type����:1�s�̓��̓t�B�[���h�Bname����:���͂��ꂽ�f�[�^�ƃZ�b�g�ő����閼�O-->
<!--value����:���̓t�B�[���h�ɂ͕s�v�Bsize����:���͗��̉����i�������j-->

<input type="submit" name="" value="���M">
<!--���M�{�^���Bvalue����:���M�{�^���ɕ\�������镶���B-->

</form>

<?php

$comment=$_POST['comment'];
//�ϐ�$comment�̎w��ƁA�t�H�[���ɓ��͂��ꂽ�f�[�^'comment'���󂯎��;

if ($comment != null){
/*if���F$comment��null�i��j�ł͂Ȃ���΁A{}���̏��������s����;
!=:��r���Z�q�i����2�̒l���r������́j�B�u���v��\���B�u���v��==�ŕ\���B;*/

$filename = 'mission_1-5.txt';
//echo $filename;

$fp = fopen($filename, 'w');
//fopen�֐��F$filename�Ƃ����t�@�C����w���[�h(=write��������)�ŊJ��;

fwrite($fp, $comment);
//fwrite�֐��F�J�����t�@�C����$comment����������;

fclose($fp);
//fclose�֐��F�J���Ă����t�@�C�������;

}

?>