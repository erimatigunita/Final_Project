<?php
//1.  DB接続します xxxにDB名を入れます
try {
$pdo = new PDO('mysql:dbname=FinalProject_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
//作ったテーブル名を書く場所  xxxにテーブル名を入れます
$stmt = $pdo->prepare("SELECT * FROM fp_table order by id DESC limit 3");
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
    // $view .= "<img src='".$result["image"]."'>".$result["name"].":".$result["shop"].":".$result["comments"].":".$result["indate"];
    $view .= "NAME : ".$result["name"]."<br>"."<img src='upload/".$result["image"]."'>"  ."COMMENTS"."<br>"."<span2>".$result["comments"]."</span2>"."<a href='".$result["shop"]."'>👉visit the website</a>"."<span>".$result["indate"]."</span>";
    $view .= "</p>";
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Final_Project</title>
  <link href="FP.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
  <script type="text/javascript">
    // $(function () {
    // var num = Math.floor(6 * Math.random());
    // $('div.wrapper').addClass('background' + num);
    // });
  </script>
</head>

<body>
<!-- <div class="body">
  <div class="bg"></div> -->


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

<div class="flex">
  <form method="post" action="insert.php" enctype="multipart/form-data">
    <div class="jumbotron">
    <fieldset>
      <div class="tesuto">
        <label>CATEGORY<br>
          <div class="categorymenu">
            <input type="radio" name="category" value="APPAREL" checked="checked">APPAREL<br>
            <input type="radio" name="category" value="JEWELRY">JEWELRY<br>
            <input type="radio" name="category" value="ACCESSORIES">ACCESSORIES<br>
            <input type="radio" name="category" value="STATIONERY">STATIONERY<br>
            <input type="radio" name="category" value="HOMEGOODS">HOME GOODS<br>
          </div>
        </label>
        <img src="share2.PNG" alt="" width="130" height="130">
      </div>
      <label>NAME<input type="text" name="name"></label><br>
      <label>SHOP<input type="text" name="shop"></label><br>
      <input type="file" name="image"><br>
      <label><textArea name="comments" rows="4" cols="40" class="comments" placeholder="COMMENTS"></textArea></label><br>
      <button type="submit">SHARE!</button>
      <!-- <input type="submit" class="button" value="SHARE!"> -->
      </fieldset>
    </div>
  </form>
</div>

<h2 class="newposts">NEW POSTS!</h2>
<p class="all">All pictures that have been posted.<br>
Get the best assist to find new favorites and get inspired
for a little better days!<br>
Remember, A pinch of ' Kawaii ' makes everything better!
</p>
<div>
    <div class="container jumbotron3"><?=$view?>

  
  
  
  </div>
</div>

<!-- </div> -->
</body>
</html>
