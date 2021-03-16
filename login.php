<?php session_start(); ?>
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
    <?php require 'nav.php';
    ?>
    <main class="main">
        <div class="main__content">
            <h1 class="content__title">名前とパスワードを半角でご入力下さい。</h1>
            <div class="content__item">
                <!-- ここにページ内要素、content__itemは増やしても大丈夫 -->

                <form class="content__date" action="login_success.php" method="POST">
                    <p>e-mail</p>
                    <input type="text" name="email">
                    <p>パスワード</p>
                    <input type="password" name="password"><br>
                    <button class="ok__button">ログイン</button>
                </form>

            </div>
        </div>
    </main>
    <!-- <footer class="footer"></footer> -->

</body>

</html>