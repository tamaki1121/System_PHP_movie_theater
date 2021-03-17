<?php session_start();
// unset($_SESSION);
// $_SESSION['site_user'] = [
//     'id' => 1,
//     'email' => 'koizumi@exsample.com',
//     'password' => 'koizumi'
// ];
// $_SESSION['movie_work_id'] = '1';
// $_SESSION['name'] = 'aaa';
// $_SESSION['url'] = 'aaa';
// $_SESSION['date_time'] = '2020-11-21';
// $_SESSION['roomName'] = 'A';
// $_SESSION['movie_plan_id'] = '1';
if (empty($_SESSION['site_user'])) {
    header('Location: ./login.php');
    exit();
}
if (!empty($_SESSION['seat'])) unset($_SESSION['seat']);
if (!isset($_POST['date'])) {
    // if (false) {
    $errorMessage = '時間ページからアクセスしてください。';
} else {
    require 'seat_data.php';
    $data = explode(',', $_POST['date']);
    $_SESSION['movie_plan_id'] = $data[0];
    $_SESSION['date_time'] = $data[1];
    $_SESSION['room_name'] = $data[2];
    if ($_SESSION['room_name'] == 'A') {
        $list = $listA;
        $room = $roomA;
    } elseif ($_SESSION['room_name'] == 'B') {
        $list = $listB;
        $room = $roomB;
    }
    $pdo = (function () {
        $user = 'myuser';
        $password = 'hoge';
        $dns = 'mysql:host=localhost;dbname=movie_theater_site;charset=utf8';

        try {
            $PDObject = new PDO($dns, $user, $password);
            $PDObject->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $PDObject->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo "DBの接続に問題がありました。";
            echo $e->getMessage();
            exit();
        }
        return $PDObject;
    })();
    try {
        $unavailable = [];
        $sql = "SELECT * 
                    FROM reserve 
                    WHERE movie_plan_id = :movie_plan_id";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(':movie_plan_id', $_SESSION['movie_plan_id'], PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as  $val) {
            $list[
                $val['seat_number']
            ] = 0;
        }
    } catch (Exception $e) {
        echo "SQLの実行に問題がありました。";
        echo $e->getMessage();
        exit();
    }
}
// foreach($list as $item):
?>
<!-- <input type="checkbox" value="<?= $item['seat_number']?>"><?= $item['seat_number']?> -->
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tamaki.css">
    <title>映画館</title>
</head>

<body>

    <?php require 'nav.php' ?>
    <main class="main">
        <div class="main__content">
            <h1 class="content__title">お好みの席をお選びください</h1>
            <div class="content__item">
                <?php if (!isset($errorMessage)) : ?>
                    <div id="app" class="form__seat-app">
                        <div class="form__seat-form">
                            <div class="seat-form__row" v-for="(items,n) in roomData">
                                <div class="seat-form__data" v-for="(item, index) in items" :class="outputData[n * items.length + index].classObj" @click="action(n * items.length + index)">
                                    <div class="seat-form__obj-text">
                                        {{outputData[n * items.length +index].text}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="seat-form__result-box">
                            <div class="seat-form__result-item" v-for="item in inputData">
                                <div class="seat-form__result-text">{{ item }}</div>
                            </div>
                            <form action="check.php" method="POST">
                                <input class="" v-for="item in inputData" type="hidden" :value="item" name="seat[]">
                                <input v-if="inputData.length > 0" type="submit" value="確定する">
                            </form>
                            <!-- <button v-if="inputData.length > 0" @click="delete" value="全て取り消す"> -->
                        </div>
                    </div>
                    <p class="seat-form__desc"><span></span>利用不可 <span></span>選択済み</p>
                <?php else : ?>
                    <p><?= $errorMessage ?></p>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <!-- <footer class="footer"></footer> -->
    <?php if (!isset($errorMessage)) : ?>
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script>
            let list = [
                <?php foreach ($list as $key => $val) : ?> {
                        name: "<?= $key ?>",
                        state: <?= $val ?>
                    },
                <?php endforeach; ?>
            ]
            let list2 = [
                <?php foreach ($room as $val) :
                    echo '[' ?>
                    <?php foreach ($val as $sVal) : ?> {
                            type: <?= $sVal['type'] ?>,
                            text: "<?= $sVal['text'] ?>"
                        },
                    <?php
                    endforeach;
                    echo '],'; ?>
                <?php endforeach; ?>
            ]
        </script>
        <script src="js/script.js"></script>
    <?php endif; ?>
</body>

</html>