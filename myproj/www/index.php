<?php session_start(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=win-1251" />
	<title>Вложенные комментарии</title>	
	<script language="JavaScript1.2" src="js/jquery.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/comments.js"></script>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div style="width:900px; heigth:100%;margin: 0 auto; float:center; background-color: #F3F3F3;">
<?php
/**
 * @author pilastro
 * @copyright 2016
 */
function getComments($CommentID){
    $dbname='db1';
    $dblocation = "localhost"; 
    $dbuser = "root";          
    $dbpasswd = ""; 
    $dbcnx = @mysql_connect($dblocation,$dbuser,$dbpasswd);
    if (!$dbcnx) 
    {
    echo("<P>сервер базы данных не доступен, поэтому 
           корректное отображение страницы невозможно.</P>");
    exit();
    }
    if (!@mysql_select_db($dbname, $dbcnx)) 
    {
    echo( "<P>В настоящий момент база данных не доступна, поэтому
            корректное отображение страницы невозможно.</P>" );
    exit();
    }
    mysql_query("SET NAMES CP1251");
    $query=" (";
    for ($i=0;$i<count($CommentID);$i++){
        $CommentID[$i]=intval($CommentID[$i]);
        if ($i==0){$query.=" parid={$CommentID[$i]} ";}
        else{$query.=" or parid={$CommentID[$i]} ";}
    }
  $query.=" )";
  //==================================================================

  $query="Select * 
          From `dbb`
          Where {$query}";

  $result = mysql_query($query);
  $result_row=array();
  $kol=-1;

  
  while ($row = mysql_fetch_array($result,MYSQL_BOTH)) 
  {
    $kol++;
    $result_row[$kol]["id"]=$row["id"];
    $result_row[$kol]["parid"]=$row["parid"];
    $result_row[$kol]["name"]=$row["name"];
    $result_row[$kol]["message"]=$row["message"];
  }

  mysql_close($dbcnx);
  return $result_row;
  }

?>

<?php
$cid=0;
$nestingLevel=5;//уровень вложенности
$counter=-1;
$CommentID=array();
$CommentID[0]=0;
?>
<div id="CommentView" style="padding: 30px 80px 50px 80px;">
<h2>Комментарии</h2>
<?php
WHILE ($counter<=$nestingLevel)
{
  $counter++;
  $commentArr=array();
  $commentArr=getComments($CommentID);

  if (count($commentArr)==0){break;}

  $CommentID=array();
  for ($i=0;$i<count($commentArr);$i++)
  {
    $CommentID[$i]=$commentArr[$i]["id"];
?>
    <div id="CommentView_Parent<?php print $commentArr[$i]['id'];?>">
    <div style="padding-left:<?php print (30*$counter)?>px;">
        <h3><?php print $commentArr[$i]["name"];?></h3>
    <div class="Message"><?php print $commentArr[$i]["message"];?>
    </div>
    <div id="<?php print $commentArr[$i]['id'];?>">
    <?php  $cid=$commentArr[$i]['id'];?>
						<br />
						<a href="commentForm.php?cid1=<?php print $cid?>" title="Ответить на комментарий" onclick="#">Ответить</a>
                        <a href="deletecomment.php?cid1=<?php print $cid?>" title="Удалить комментарий" onclick="#">  Удалить</a> 
                        
    </div>
    <div id="CommentView_Form<?php print $commentArr[$i]['id'];?>" style="padding-top:5px;clear:left;"></div>
				
    </div>
    <div id="CommentView_Child<?php print $commentArr[$i]['id'];?>"></div>
    </div>
<?php
		//перенос вложенного комментария родителю
		if ($counter<>0){
			print "<script type=\"text/javascript\">CommentView_TeleportChild(\"{$commentArr[$i]['parid']}\",\"{$commentArr[$i]['id']}\");</script>";
		}
?>

<?php
}
    }
?>
<br />
    <form target="_blank" action="commentForm.php" method="POST"> 
<input type="submit" value="Добавить комментарий" class="button7"> 
</form>
	<div id="CommentView_Form0"></div>
</div>
</div>

</body>
</html>