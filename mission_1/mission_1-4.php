<?php
$comment=$_POST['comment'];
//�ϐ�$���w��B''��name�����B������php���f�[�^���󂯎��;
echo $comment;
//echo:�ϐ�$comment���u���E�U�ŕ\��;
?>

<form method="POST" action="mission_1-4.php">
<!--method:�ǂ̂悤�Ƀf�[�^�𑗐M���邩�BPOST�܂���GET�Baction:�f�[�^�̑��M��-->

<input type="text" name="comment" value="" size="">
<!--input type����:1�s�̓��̓t�B�[���h�Bname����:���͂��ꂽ�f�[�^�ƃZ�b�g�ő����閼�O-->
<!--value����:���̓t�B�[���h�ɂ͕s�v�Bsize����:���͗��̉����i�������j-->

<input type="submit" name="" value="���M">
<!--���M�{�^���Bvalue����:���M�{�^���ɕ\�������镶���B-->

</form>