<?php session_start(); ?>
<?php
unset($_SESSION['site_user']);
require 'db_conect.php';
$sql = "select * from site_user where email = :email and password = :password";
$stm = $pdo->prepare($sql);
$stm->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
$stm->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
$stm->execute();
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $_SESSION['site_user'] = [
        'email' => $row['email'],
        'password' => $row['password'],
        'id' => $row['id']
    ];
}
?>

<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/watanabe.css">
    <title>ログイン</title>
</head>

<body>
    <?php
    require 'nav.php';
    ?>
    <main class="main">
        <div class="main__content">
            <h1 class="content__title"></h1>
            <div class="content__item">
                <!-- ここにページ内要素、content__itemは増やしても大丈夫 -->
                <div class="content__date">
                    <?php
                    if (isset($_SESSION['site_user'])) {
                        echo 'ログインに成功しました。<br>';
                    } else {
                        echo 'ログイン名またはパスワードが違います。<br>';
                    }
                    ?>
                    <button class="back__button" onclick="location.href='home.php'">TOPへ</button>
                </div>

            </div>
        </div>
    </main>
    <footer class="footer"></footer>
</body>

</html>