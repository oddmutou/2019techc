<?php
// 接続 ref. https://www.php.net/manual/ja/pdo.connections.php
$dbh = new PDO('mysql:host=database-1.csnl2wojipk7.us-east-1.rds.amazonaws.com;dbname=bbs_db', 'admin', 'password');

// 行の中身を取る
$select_sth = $dbh->prepare('SELECT name, body, created_at FROM bbs ORDER BY id ASC');
$select_sth->execute();
$rows = $select_sth->fetchAll();
?>

<?php foreach ($rows as $row) : ?>
<div>
    <span><?php if ($row['name']) { echo $row['name']; } else { echo "名無し"; } ?>さんの投稿 (投稿日: <?php echo $row['created_at']; ?>)</span>
    <p>
        <?php echo $row['body']; ?>
    </p>
</div>  
<?php endforeach; ?>


<hr>


<form method="POST" action="./bbs_write.php">
    <div>
        名前: <input type="text" name="name">
    </div>  
    <div>
        <textarea name="body" rows="5" cols="100" required></textarea>
    </div>  
    <input type="submit">
</form> 
