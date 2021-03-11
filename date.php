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
    <?php
    $user = 'myuser';
    $password = 'hoge';
    $dns = 'mysql:host=localhost;dbname=movie_theater_site;charset=utf8';
    $pdo = new PDO($dns, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    try {
    } catch (Exception $e) {
        echo 'DB接続エラー<br>';
        echo $e->getMessage();
        exit();
    }
    try {
        $sql = 'SELECT * FROM movie_plan WHERE movie_work_id = 1 AND date_time >= "2021-03-01 09:00:00" AND date_time <= "2021-03-07 23:59:59"';
        $stm = $pdo->prepare($sql);
        if ($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (Exception $e) {
        echo 'クエリに問題があります。';
        echo $e->getMessage();
        exit();
    }
    ?>
    <header class="header">
        <nav class="header__nav">
            <ul class="nav__list">
                <li class="nav__item--logo">
                    <a href="home.html">
                        <img class="nav__logo-img" src="logo.png" alt="">
                    </a>
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
            <h1 class="content__title">上映日時</h1>
            <div class="content__item">
                <!-- ここにページ内要素、content__itemは増やしても大丈夫 -->
                <p>日付を選択してください</p>
                <form action="#" method="POST">
                    <div>
                        <img class="date__img" src="" alt="">
                    </div>
                    <ul class="content__radio">
                        <?php
                        foreach ($result as $item) {

                        ?>
                            <li>
                                <label for="hiniti<?= $item['id'] ?>"></label><input type="radio" name="hiniti" id="hiniti<?= $item['id'] ?>" value="{id :<?= $item['id'] ?>, room_name: <?= $item['room_name'] ?>, }"><?= $item['date_time'] ?></label>
                            </li>
                        <?php } ?>
                        <div>
                            <input type="submit" value="次へ" class="content__button">

                        </div>
                    </ul>
                </form>
            </div>

        </div>
    </main>
    <!-- <footer class="footer"></footer> -->
</body>

</html>