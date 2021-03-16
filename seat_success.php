<?php
session_start();
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
// $_SESSION['seat'][] = 'A-1';
// $_SESSION['seat'][] = 'B-2';
// $_SESSION['seat'][] = 'C-3';
if (empty($_SESSION['site_user'])) {
    header('Location: ./login.php');
    exit();
}
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
if (!isset($errotMessage)) {
    require 'db_conect.php';
    $result['result'] = 0;
    try {
        $sql = 'SELECT COUNT(*) AS result FROM reserve WHERE movie_plan_id = ? AND seat_number IN (';
        for ($i = 0; $i < count($_SESSION['seat']); $i++) {
            $sql .= '?';
            if ($i + 1 == count($_SESSION['seat'])) break;
            $sql .= ',';
        }
        $sql .= ");";
        $stm = $pdo->prepare($sql);
        $stm->bindValue(1, $_SESSION['movie_plan_id'], PDO::PARAM_INT);
        foreach ($_SESSION['seat'] as $index => $val) {
            $stm->bindValue($index + 2, $val, PDO::PARAM_STR);
        }

        if ($stm->execute()) {
            $result = $stm->fetch(PDO::FETCH_ASSOC);
        }
    } catch (Exception $e) {
        // $errotMessage[] = $e->getMessage();
        $errotMessage[] = '登録に問題がありました';
    }
    if ($result['result'] == 0) {
        try {
            $sql = '
        INSERT INTO reserve (id, site_user_id, movie_plan_id, seat_number) VALUE ';
            for ($i = 0; $i < count($_SESSION['seat']); $i++) {
                $sql .= '(NULL, ?, ?, ?)';
                if ($i + 1 == count($_SESSION['seat'])) break;
                $sql .= ',';
            }
            $sql .= ";";
            $stm = $pdo->prepare($sql);
            foreach ($_SESSION['seat'] as $index => $val) {
                $stm->bindValue(1 + 3 * $index, $_SESSION['site_user']['id'], PDO::PARAM_INT);
                $stm->bindValue(2 + 3 * $index, $_SESSION['movie_plan_id'], PDO::PARAM_INT);
                $stm->bindValue(3 + 3 * $index, $val, PDO::PARAM_STR);
            }
            $stm->execute();
        } catch (Exception $e) {
            // $errotMessage[] = $e->getMessage();
            $errotMessage[] = '登録に問題がありました';
        }
    } else {
        $errotMessage[] = '席がすでに使用されています。';
        $errotMessage[] = '座席指定からやり直して下さい';
    }
    unset($_SESSION['seat']);
} ?>
<!DOCTYPE html>
<html lang="jp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/tamaki.css">
    <title>登録完了ページ</title>
</head>

<body>
    <?php require 'nav.php'; ?>
    <main class="main">
        <div class="main__content">
            <h1 class="content__title">完了ページ</h1>
            <div class="content__item">
                <?php if (isset($errotMessage)) : ?>
                    <?php foreach ($errotMessage as $val) : ?>
                        <p><?= $val ?></p>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class="item__success">登録が完了しました</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <!-- <footer class="footer"></footer> -->
</body>

</html>