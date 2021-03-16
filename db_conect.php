<?php
  $user = 'myuser';
  $password = 'hoge';
  $dbName = 'movie_theater_site';
  $host = '%';
  $dsn = "mysql:host=localhost;dbname={$dbName};charset=utf8";
  try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo '<span class="error">エラーがありました。</span><br>';
    echo $e->getMessage();
    exit();
  }
  ?>