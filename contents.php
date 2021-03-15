<?php session_start() ?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ruka0315.css">
    <title>映画館</title>
</head>

<body>
    <?php
    if (!empty($_SESSION['movie_work_id'])) unset($_SESSION['movie_work_id']);
    if (!empty($_SESSION['name'])) unset($_SESSION['name']);
    if (!empty($_SESSION['url'])) unset($_SESSION['url']);
    if (!empty($_SESSION['movie_plan_id'])) unset($_SESSION['movie_plan_id']);
    if (!empty($_SESSION['date_time'])) unset($_SESSION['date_time']);
    if (!empty($_SESSION['room_name'])) unset($_SESSION['room_name']);
    if (!empty($_SESSION['seat'])) unset($_SESSION['seat']);
    $user = 'myuser';
    $password = 'hoge';
    $dns = 'mysql:host=localhost;dbname=movie_theater_site;charset=utf8';
    try {
        $pdo = new PDO($dns, $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    } catch (Exception $e) {
        echo 'DB接続エラー<br>';
        echo $e->getMessage();
        exit();
    }

    try {
        $sql = 'SELECT * FROM movie_work';
        $stm = $pdo->prepare($sql);
        if ($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (Exception $e) {
        echo 'クエリ1に問題があります。';
        echo $e->getMessage();
        exit();
    }



    ?>
    <?php require 'nav.php';
    ?>
    <main class="main" id="app">
        <div class="main__content">
            <h1 class="content__title">作品一覧</h1>

            <?php
            foreach ($result as $item) {
            ?>
                <form action="date.php" method="POST" name="ichiran<?= $item['id'] ?>">
                    <input type="hidden" value="<?= $item['id'] ?>" name="id">
                    <input type="hidden" value="<?= $item['name'] ?>" name="name">
                    <input type="hidden" value="<?= $item['url'] ?>" name="url">
                    <div class="content__item --sakuhin">
                        <a class="content__img" onclick="document.ichiran<?= $item['id'] ?>.submit()">
                            <img src="<?= $item['url'] ?>" alt="">
                        </a>
                        <div class="content__sakuhin">
                            <a onclick="document.ichiran<?= $item['id'] ?>.submit()">
                                <h2 class="content__sakuhinmei"><?= $item['name'] ?></h2>
                            </a>
                            <p class="content__arasuzi"><?= $item['description'] ?></p>
                        </div>
                    </div>
                </form>
            <?php
            }

            ?>
        </div>

    </main>


    <!-- <footer class="footer"></footer> -->
</body>

</html>