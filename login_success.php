<?php session_start(); ?>

<?php
//customerセッション変数を破棄
unset($_SESSION['site_user']);
//MySQLデータベースに接続する
require 'db_conect.php';
//SQL文を作る（プレースホルダを使った式）
$sql = "select * from site_user where email = :email and password = :password";
//プリペアードステートメントを作る
$stm = $pdo->prepare($sql);
//プリペアードステートメントに値をバインドする
$stm->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
$stm->bindValue(':password', $_POST['password'], PDO::PARAM_STR);
//SQL文を実行する
$stm->execute();
//結果の取得（連想配列で受け取る）
$result = $stm->fetchAll(PDO::FETCH_ASSOC);
//customerセッションの設定
foreach ($result as $row) {
    $_SESSION['site_user'] = [
        'email' => $row['email'],
        'password' => $row['password']
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
    <header class="header">
        <nav class="header__nav">
            <ul class="nav__list">
                <li class="nav__item--logo">
                    <a href=""></a>
                    <img class="nav__logo-img" src="img/logo.png" alt="">
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="login.php">
                        <span class="nav__link-inner">ログイン</span>
                    </a>
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="google.com">
                        <span class="nav__link-inner">作品一覧</span>
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="main">
        <div class="main__content">
            <h1 class="content__title"></h1>
            <div class="content__item">
                <!-- ここにページ内要素、content__itemは増やしても大丈夫 -->
                <div class="content__date">
                    <?php
                    if (isset($_SESSION['site_user'])) {
                        echo 'ログインに成功しました。';
                    } else {
                        echo 'ログイン名またはパスワードが違います。<br>';
                    }
                    ?>
                    <button class="back__button" onclick="location.href='./template.html'">TOPへ</button>
                </div>

            </div>
        </div>
    </main>
    <footer class="footer"></footer>
</body>

</html>

