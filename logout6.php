<?php

session_start();

$erroemessage="";

if(isset($_SESSION["NAME"])){
  $errormessage='ログアウトしました';
}

//セッション変数クリア
$_SESSION=array();

//セッションクリア
@session_destroy();


?>


<html>
<meta charset="UTF-8">
<h1>ログアウト画面</h1>
<div><?php echo htmlspecialchars($errormessage,ENT_QUOTES); ?></div>

<ul><li><a href="login6.php">ログイン画面に戻る</a></li></ul>
</html>

