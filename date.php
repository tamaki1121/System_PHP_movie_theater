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
    if (!empty($_SESSION['movie_work_id'])) unset($_SESSION['movie_work_id']);
    if (!empty($_SESSION['name'])) unset($_SESSION['name']);
    if (!empty($_SESSION['url'])) unset($_SESSION['url']);
    if (!empty($_SESSION['seat'])) unset($_SESSION['seat']);
    if (!isset($_POST['name']) && !isset($_POST['id']) && !isset($_POST['url'])) {
        $errorMessage = '作品一覧からアクセスして下さい。';
    } else {
        $_SESSION['movie_work_id'] = $_POST['id'];
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['url'] = $_POST['url'];

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
            $sql = 'SELECT * FROM movie_plan WHERE movie_work_id = :id  AND date_time >= "2021-03-01 09:00:00" AND date_time <= "2021-03-07 23:59:59"';
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
                                    <label for="hiniti<?= $item['id'] ?>">
                                        <input type="radio" name="hiniti" id="hiniti<?= $item['id'] ?>" value="<?= $item['id'] ?>,<?= $item['date_time'] ?>,<?= $item['room_name'] ?>">
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
>>>>>>> origin/imai
