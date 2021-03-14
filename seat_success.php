<?php
if (empty($_SESSION['site_user'])) $errotMessage[] = 'ログインしてください。';
if (
    empty($_SESSION['movie_work_id'])
    && empty($_SESSION['name'])
    && empty($_SESSION['url'])
) {
    $errotMessage[] = '作品が選択されていません。';
}
if (
    empty($_SESSION['date_time'])
    && empty($_SESSION['roomName'])
    && empty($_SESSION['movie_plan_id'])
) {
    $errotMessage[] = '時間が選択されていません。';
}
if (empty($_SESSION['seat'])) $errotMessage[] = '席が選択されていません。';
if (isset($errotMessage)) {
    $_SESSION['seat'][] = 'A-1';
    $_SESSION['seat'][] = 'B-2';
    $_SESSION['seat'][] = 'C-3';
    require 'db_conect.php';
    try {
        $sql = '
        INSERT INTO reserve (id, site_user_id, movie_plan_id, seat_number) VALUE ';
        for ($i = 0; $i < count($_SESSION['seat']); $i++) {
            $sql .= '(NULL, ?, ?, ?)';
            if ($i + 1 == count($_SESSION['seat'])) break;
            $sql .= ',';
        }
        $sql .= ",(NULL, 1, 3, '1');";
        $stm = $pdo->prepare($sql);
        foreach ($_SESSION['seat'] as $index => $val) {
            $stm->bindValue(1 + 3 * $index, 1, PDO::PARAM_INT);
            $stm->bindValue(2 + 3 * $index, 3, PDO::PARAM_INT);
            $stm->bindValue(3 + 3 * $index, $val, PDO::PARAM_STR);
        }
        $stm->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
} ?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>映画館</title>
</head>

<body>
    <header class="header">
        <nav class="header__nav">
            <ul class="nav__list">
                <li class="nav__item--logo">
                    <a href=""></a>
                    <img class="nav__logo-img" src="images/logo.png" alt="">
                </li>
                <li class="nav__item">
                    <a class="nav__link" href="google.com">
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
            <h1 class="content__title">完了ページ</h1>
            <div class="content__item">
                <p class="item__success">登録が完了しました</p>
            </div>
        </div>
    </main>
    <!-- <footer class="footer"></footer> -->
</body>

</html>