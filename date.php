<?php session_start(); ?>
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
    // $_SESSION['site_user'] = 'login';
    if (empty($_SESSION['site_user'])) {
        header('Location: login.php');
        exit();
    }
    if (!empty($_SESSION['movie_work_id'])) unset($_SESSION['movie_work_id']);
    if (!empty($_SESSION['name'])) unset($_SESSION['name']);
    if (!empty($_SESSION['url'])) unset($_SESSION['url']);
    if (!empty($_SESSION['seat'])) unset($_SESSION['seat']);
    if (!isset($_POST['name']) && !isset($_POST['id']) && !isset($_POST['url']) && !isset($errorMessage)) {
        $errorMessage = '作品一覧からアクセスして下さい。';
    } else if (!isset($errorMessage)) {
        $_SESSION['movie_work_id'] = $_POST['id'];
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['url'] = $_POST['url'];

        require "db_conect.php";

        try {
            $sql = '
            SELECT * 
            FROM movie_plan 
            WHERE movie_work_id = :id
            AND date_time >= CURRENT_TIMESTAMP
            AND date_time <= DATE_ADD(CURRENT_DATE, INTERVAL 7 DAY);';
            $stm = $pdo->prepare($sql);
            $stm->bindValue(':id', $_SESSION['movie_work_id'], PDO::PARAM_INT);
            if ($stm->execute()) {
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
            }
        } catch (Exception $e) {
            echo 'クエリに問題があります。';
            echo $e->getMessage();
            exit();
        }
    }
    ?>
    <?php
    require 'nav.php';
    ?>
    <main class="main">
        <div class="main__content">
            <h1 class="content__title">上映日時</h1>
            <div class="content__item">
                <!-- ここにページ内要素、content__itemは増やしても大丈夫 -->
                <?php if (!isset($errorMessage)) {
                ?>
                    <p>日付を選択してください</p>
                    <img class="date__img" src="images/<?= $_SESSION['url'] ?>" alt="">
                    <form action="seat.php" method="POST" class="content__radio">
                        <ul>
                            <?php
                            foreach ($result as $item) {

                            ?>
                                <li>
                                    <label for="date<?= $item['id'] ?>">
                                        <input type="radio" name="date" id="date<?= $item['id'] ?>" value="<?= $item['id'] ?>,<?= $item['date_time'] ?>,<?= $item['room_name'] ?>">
                                        <?= $item['date_time'] ?>
                                    </label>
                                </li>
                            <?php } ?>
                            <div>
                                <input type="submit" value="次へ" class="content__button">

                            </div>
                        </ul>
                    </form>
                <?php } else { ?>
                    <p><?= $errorMessage ?></p>
                <?php } ?>
            </div>

        </div>
    </main>
    <!-- <footer class="footer"></footer> -->
</body>

</html>