
<meta charset="UTF-8">
<?php 
session_start();

require "header.php";
require "db.php";
;

//セッション情報消去
unset($_SESSION["user"]);

$sql=$pdo->prepare('select * from techemail3 where mail=? and pass=? and registered=1');
$sql->execute([$_POST["mail"],$_POST["pass"]]);
foreach($sql as $row){

$_SESSION["user"]=["id"=>$row["id"],"name"=>$row["name"]];

}

if(isset($_SESSION["user"])){
  echo $_SESSION["user"]["id"];
  echo "ログイン完了";
}
else{
  echo "ログインできません";
}
?>