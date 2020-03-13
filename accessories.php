<?php
//1.  DB接続します xxxにDB名を入れます
try {
$pdo = new PDO('mysql:dbname=FinalProject_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
//作ったテーブル名を書く場所  xxxにテーブル名を入れます
$stmt = $pdo->prepare("SELECT * FROM fp_table WHERE 'ACCESSORIES' = category order by id DESC");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる $resultの中に「カラム名」が入ってくるのでそれを表示させる例
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= "<p>";
    $view .= "NAME : ".$result["name"]."<br>"."<img src='upload/".$result["image"]."'>"  ."COMMENTS"."<br>"."<span2>".$result["comments"]."</span2>"."<a href='".$result["shop"]."'>👉visit the website</a>"."<span>".$result["indate"]."</span>";
    $view .= "</p>";
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ACCESSORIES</title>
<link rel="stylesheet" href="css/range.css">
<link href="FP.css" rel="stylesheet">
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->

<header>
  <div class="top">
    <div class="top_container">A pinch of ' Kawaii ' makes everything better!</div>
  </div>

  <h1>
    <a href="index.php">
    <img src="logologologo.png" alt=""></a>
  </h1>

  <div class="index">
    <div class="index_theme"> 
      
      <a href="select.php">
        <div class="indexdiv">
          <span class="span2">ALL</span>
        </div>
      </a>
      
      <a href="apparel.php">
        <div>
          <span class="span2">APPAREL</span>
        </div>
      </a>

      <a href="jewelry.php">
        <div>  
          <span class="span2">JEWELRY</span>
        </div>
      </a>

      <a href="accessories.php">
        <div>
          <span class="span2">ACCESSORIES</span>
        </div>
      </a>

      <a href="stationery.php">
        <div>    
          <span class="span2">STATIONERY</span>
        </div>
      </a>

      <a href="homegoods.php">
        <div>
          <span class="span2">HOME GOODS</span>
        </div>
      </a>

    </div>
  </div>
</header>

<h2 class="pages">ACCESSORIES</h2>

<p class="all">All pictures that have been posted.<br>
Get the best assist to find new favorites and get inspired
for a little better days!<br>
Remember, A pinch of ' Kawaii ' makes everything better!
</p>

<div>
    <div class="container jumbotron2"><?=$view?></div>
</div>

</body>
</html>
