<?php
Header ('Location: index.php');
function funcCommentAdd($idparent,
						$user,
						$message){
	//Соединение с БД
	$db = mysql_connect("localhost", "root", "");
	mysql_select_db("db1");
	mysql_query('SET NAMES CP1251');
	
	//Запрос в БД
	$query = "	INSERT INTO `dbb`
				VALUES (
                        NULL,
                        '{$idparent}',
						
						
						'{$user}',
						
						'{$message}'
						
						)";
	$result = mysql_query($query);
    echo($query);
	mysql_close($db);
	return $result;
}

        $ParentID=0;
        if (!empty ($_POST['ParentID']) )
        {
        $ParentID=intval($_POST['ParentID']);
        }
        
		$Message=htmlspecialchars($_POST['message'],ENT_QUOTES);
		$User=htmlspecialchars($_POST['name'],ENT_QUOTES);
		$Parent=intval($_POST['CommentParent']);
        echo($User);
        echo($Message);
        echo($Parent);
		
		
		//Добавление комментария в базу
		funcCommentAdd($ParentID,$User,$Message);
       
   exit();
?>