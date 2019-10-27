<?php


//ＤＢへのせつぞく
$dsn='mysql:dbname=データベース名; host=localhost';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));



//テーブル作成
$sql="CREATE TABLE IF NOT EXISTS tbtbtest"
."("
."id INT AUTO_INCREMENT PRIMARY KEY,"    //ＩＮＴは整数を入力する場合＆連続した数値をカラムに格納
."name char(32),"                        //charは文字データをまとめる(名前　３２字まで）
."comment TEXT,"
."created_on DATETIME,"
."pass TEXT"
.");";
$stmt=$pdo->query($sql);                  //実行後に結果情報が格納されたPDOStatementオブジェクトに返す















if(!empty($_POST["name"]) &&!empty($_POST["comment"])) {

		if(empty($_POST["edit2"])) {              //hiddenフォームが空のとき

			if(!empty($_POST['pass1'])){            //パスワードが空じゃなかったら


//投稿時間の表示
$DATETIME=new DATETIME();
$DATETIME=$DATETIME -> format('Y-m-d H:i:s');



//テーブルにデータ入力
$sql=$pdo -> prepare("INSERT INTO tbtbtest(name,comment,created_on,pass) VALUES(:name, :comment, :created_on, :pass)");   //VALUESでテーブル名に対してパラメータを与える
$sql -> bindParam(':name', $name, PDO::PARAM_STR);                                   //PARAM～は「文字列」の意味
$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
$sql -> bindValue(':created_on', $DATETIME,PDO::PARAM_STR);
$sql -> bindParam(':pass', $pass, PDO::PARAM_STR);
$name=$_POST['name'];
$comment=$_POST['comment'];
$pass=$_POST['pass1'];
$sql->execute();      //ここでprepareで用意したＳＱＬをＤＢにＩＮＳＥＲＴしてる＝命令を実行させる

    



   }
 }
}




if(!empty($_POST["dnum"]) &&!  empty($_POST["pass2"])) {                               //フォームとパスワード空でないとき
	



//deleteによって削除
$id=$_POST["dnum"];
$sql='delete from tbtbtest where id=:id and pass=:pass';
$stmt=$pdo -> prepare($sql);
$stmt -> bindParam(':id',$id,PDO::PARAM_INT);
$stmt -> bindParam(':pass',$pass,PDO::PARAM_STR);
$pass=$_POST["pass2"];
$stmt -> execute();
   
  
} //フォームとパスワードが空でないとき

 


//SELECT文でフォームに表示させる（編集機能）
if(!empty($_POST["enum"])  &&! empty($_POST["pass3"])) {  //フォームとパスワードが空でないとき



$sql="SELECT * FROM tbtbtest WHERE id=:id AND pass=:pass";
$stmt=$pdo -> prepare($sql);
$stmt -> bindParam(':id',$id,PDO::PARAM_INT);
$stmt -> bindParam(':pass',$pass,PDO::PARAM_STR);
$enum=$_POST["enum"];
$id=$enum;
$pass=$_POST["pass3"];

$stmt -> execute();

$sql='SELECT * FROM tbtbtest';
$stmt=$pdo -> query($sql);
$results=$stmt -> fetchALL();

foreach ($results as $row){
	if(($id == $row["id"]) && ($pass == $row["pass"])){

        
                     $name_edit= $row["name"];
                     $comment_edit = $row["comment"];
           
                    echo $name_edit." ".$comment_edit."<br>";
                    
   }
  }
}

//編集機能
if(!empty($_POST["edit2"])){

	if(isset($_POST["edit2"])){              //hiddenフォームに表示されたら

		if(!empty($_POST["pass1"])){     //パスワードが空じゃなかったら

$id=$_POST['edit2'];
$name=$_POST['name'];
$comment=$_POST['comment'];
$pass=$_POST['pass1'];

$sql='UPDATE tbtbtest SET name=:name,comment=:comment,pass=:pass WHERE id=:id AND pass=:pass';
$stmt=$pdo -> prepare($sql);
$stmt -> bindParam(':name',$name,PDO::PARAM_STR);
$stmt -> bindParam(':comment',$comment,PDO::PARAM_STR);
$stmt -> bindParam(':id',$id,PDO::PARAM_INT);
$stmt -> bindParam(':pass',$pass,PDO::PARAM_STR);
$stmt -> execute();
 
   }
 }
}




?>










<form action="#" method="post" >
<p>名前:<br>
<input type="text" name="name" value="<?php if(!isset($name_edit)){echo "";}else{echo $name_edit;}  ?>"></p> 

<p>コメント:<br>
<meta charset="utf-8">
<textarea name="comment" cols="30" rows="5">
<?php if(!isset($comment_edit)){echo "";}else{echo $comment_edit
;} ?></textarea>

<br><input type="text" name="pass1">
<input type="submit" value="送信"></p>

<p><input type="hidden" name="edit2" value="<?php if(!isset($enum)){echo "";}else{echo $enum;} ?>"></p>

<p>削除対象番号:<br>
<input type="text" name="dnum"><br>

<input type="text"  name="pass2">
<input type="submit" name="delete" value="削除"></p>

<p>編集対象番号:<br>
<input type="text"   name="enum"><br>

<input type="text" name="pass3">
<input type="submit" name="edit" value="編集"></p>
</form>




<?php

//データ入力（select)
$sql='SELECT * FROM tbtbtest';         //SELECT文でtbtestテーブルからデータを取得
$stmt=$pdo -> query($sql);
$results=$stmt -> fetchALL();        //fetchALLですべてのデータを配列としてかえす
foreach ($results as $row){
         echo $row['id'].',';
         echo $row['name'].',';
         echo $row['comment'].',';
         echo $row['created_on'].'<br>';
echo "<hr>";
}

?>