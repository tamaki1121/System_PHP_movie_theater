<?php session_start() ?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>映画館</title>
</head>

<body>
    <?php
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
    <main class="main" id="app">
        <div class="main__content">
            <h1 class="content__title">作品一覧</h1>

            <?php
            foreach ($result as $item) {
            ?>
                <div class="content__item --sakuhin">
                    <div class="content__img" v-on:click="action(<?= $item['id'] ?>)">
                        <img src="<?= $item['url'] ?>" alt="">
                    </div>
                    <div class="content__sakuhin">
                        <h2 class="content__sakuhinmei" v-on:click="action(<?= $item['id'] ?>)"><?= $item['name'] ?></h2>
                        <p class="content__arasuzi"><?= $item['description'] ?></p>
                    </div>
                </div>
            <?php
            }

            ?>
            <form action="" method="POST" name="ichiran">
                <input type="text" v-model="input">
            </form>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script>
        new Vue({
            el: '#app',
            data: {
                input: ''
            },
            methods: {
                action: function(data) {
                    this.input = data;
                    // document.ichiran.submit();
                }
            }
        })
    </script>

    <!-- <footer class="footer"></footer> -->
</body>

</html>