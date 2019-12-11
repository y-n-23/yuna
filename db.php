<?php


//‚c‚aÚ‘±
$db['host']="localhost";
$db['user']="***";
$db['password']="***";
$db['dbname']="***";
$dsn=sprintf('mysql: host=%s; dbname=%s; charset=utf8',$db['host'],$db['dbname']);

$pdo=new PDO($dsn,$db['user'],$db['password'],array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));



//ƒe[ƒuƒ‹
$sql="CREATE TABLE IF NOT EXISTS techemail3"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"   
."name char(20),"                       
."mail char(50),"
."pass char(32),"
."registered int"
.");";
$stmt=$pdo->query($sql);

?>