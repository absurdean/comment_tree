<?php
Header ('Location: index.php');
$db = mysql_connect("localhost", "root", "");
mysql_select_db("db1");
mysql_query('SET NAMES CP1251');
    
    
function delete_by_child($child)
    {
        $querydel="DELETE FROM dbb WHERE id={$child}";
        print $querydel;
        $result = mysql_query($querydel);
        return $result;
    }
    
$cid = $_GET[ 'cid1' ];
    
$c=delete_by_child($cid); 
	//Запрос в БД
$querychild = "	SELECT id FROM dbb WHERE parid={$cid}";
$qc= mysql_query($querychild);
$row = mysql_fetch_assoc($qc);
$qcid=$row["id"];
echo( $qcid);
if (!$qcid)
    {
        return;
    }
foreach($qcid as $child)
    {
       $c=delete_by_child($child); 
    }
$c=delete_by_child($qcid); ;
mysql_close($db);
 exit();
    ?>