<?php
// 必須である投稿本文がない場合は何もせずに閲覧画面に飛ばす
if( empty($_POST['body']) ) { 
  header("HTTP/1.1 302 Found");
  header("Location: ./bbs_read.php");
  return;
}

// 接続 ref. https://www.php.net/manual/ja/pdo.connections.php
$dbh = new PDO('mysql:host=database-1.csnl2wojipk7.us-east-1.rds.amazonaws.com;dbname=bbs_db', 'admin', 'password');

// INSERTする
$insert_sth = $dbh->prepare("INSERT INTO bbs (name, body) VALUES (:name, :body)");
$insert_sth->execute(array(
    ':name' => $_POST['name'],
    ':body' => $_POST['body'],
));

// 投稿が完了したので閲覧画面に飛ばす
header("HTTP/1.1 303 See Other");
header("Location: ./bbs_read.php");
?>
