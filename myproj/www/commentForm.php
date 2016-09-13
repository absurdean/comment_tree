<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=win-1251" />
	<title>Добавить комментарий</title>	
	<link rel="stylesheet" href="css/style.css">
</head>
<body style="background-color: #F3F3F3;">
<div id="CommentForm">
<form action="addcomment.php" method="POST" name="CommentFormSend">
	<div class="header">
		<div><h1>Добавить комментарий</h1></div>
	</div>
	<br />
	<br />
	
	<div class="field">
		<input name="name" id="name" value="Имя" onfocus="if(this.value == '' || this.value == 'Имя'){this.value = ''}" onblur="if(this.value == ''){this.value = 'Имя'}" />
	
		<br />
		<br />
		<textarea name="message" id="message"></textarea>
	</div>
	<br />
    <div>
			<br />
			<button onclick="<? "return False;"?>" class="button17">Добавить</button>
 <?php
 $label = 'cid1';
$cid1 = 0;
if (  !empty( $_GET[ $label ] )  )
{
  $cid1 = $_GET[ $label ];
}
?>
		</div>	
	<input type="hidden" name="CommentParent" id="CommentParent">
    <input type="hidden" name="ParentID" value="<?php print $cid1;?>">
</form>
</div>
</body>
</html>
						