<?php
//1. POSTデータ取得

//まず前のphpからデーターを受け取る（この受け取ったデータをもとにbindValueと結びつけるため）
$category = $_POST["category"];
$image = $_FILES["image"];
$name = $_POST["name"];
$shop = $_POST["shop"];
$comments = $_POST["comments"];

// var_dump($image);
// exit;

//2. DB接続します xxxにDB名を入力する
//ここから作成したDBに接続をしてデータを登録します xxxxに作成したデータベース名を書きます
try {
  $pdo = new PDO('mysql:dbname=FinalProject_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
  if (move_uploaded_file($_FILES["image"]["tmp_name"], "upload/" . $_FILES["image"]["name"])) {
    chmod("files/" . $_FILES["image"]["name"], 0644);
    echo $_FILES["image"]["name"] . "をアップロードしました。";
  } else {
    echo "ファイルをアップロードできません。";
    exit;
  }
} else {
  echo "ファイルが選択されていません。";
  exit;
}

//３．データ登録SQL作成 //ここにカラム名を入力する
//xxx_table(テーブル名)はテーブル名を入力します
$stmt = $pdo->prepare("INSERT INTO fp_table(id, category, image, name, shop, comments,
indate )VALUES(NULL, :category, :image, :name, :shop, :comments, sysdate())");
$stmt->bindValue(':category', $category, PDO::PARAM_STR);
$stmt->bindValue(':image', $image["name"], PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':name', $name, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':shop', $shop, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':comments', $comments, PDO::PARAM_STR); 
$status = $stmt->execute();

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト 書くときにLocation: in この:　のあとは半角スペースがいるので注意！！
  header("Location: index.php");
  exit;
}

