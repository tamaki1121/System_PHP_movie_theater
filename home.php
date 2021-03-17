<?php
session_start();
?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/imai.css">
    <title>映画館</title>
</head>

<body>
    <?php
    require 'nav.php';
    require 'db_conect.php';
    try {
        $sql = 'SELECT * FROM movie_work limit 3';
        $stm = $pdo->prepare($sql);
        if ($stm->execute()) {
            $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (Exception $e) {
        echo 'クエリ1に問題があります。';
        echo $e->getMessage();
        exit();
    }
    if (!empty($_SESSION['site_user'])) {
        try {
            $sql = 'SELECT * FROM reserve WHERE site_user_id = :id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':id', $_SESSION['site_user']['id'], PDO::PARAM_INT);
            if ($stmt->execute()) {
                $result2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            echo 'クエリ1に問題があります。';
            echo $e->getMessage();
            exit();
        }
    }
    ?>
    <main class="main">
        <div class="main__content">
            <h1 class="content__title">おすすめ映画一覧</h1>
            <div class="content__item">
                <?php
                foreach ($result as $item) {
                ?>
                    <div class="content__data">
                        <form action="date.php" method="POST" name="ichiran<?= $item['id'] ?>">
                            <input type="hidden" value="<?= $item['id'] ?>" name="id">
                            <input type="hidden" value="<?= $item['name'] ?>" name="name">
                            <input type="hidden" value="<?= $item['url'] ?>" name="url">
                            <h2 class="topic"><?= $item['name'] ?></h2>
                            <!--映画ポスター　だいたい200*400ぐらい？-->
                            <a onclick="document.ichiran<?= $item['id'] ?>.submit()">
                                <img class="content__img" src="images/" alt=""></a>
                        </form>
                    </div>
                <?php
                }
                ?>

            </div>
            <h1 class="content__title"> ご予約状況
            </h1>
            <div class="content__item">
                <?php
                foreach ($result2 as $item) {
                ?>
                    <div class="content__data--topic">

                        <p><?= $item['movie_plan_id'] ?>:<?= $item['seat_number'] ?></p>
                    </div>
                <?php
                }
                ?>

            </div>
            <!-- ここにページ内要素、content__itemは増やしても大丈夫 -->
        </div>
        </div>
    </main>
    <!-- <footer class="footer"></footer> -->
</body>

</html>