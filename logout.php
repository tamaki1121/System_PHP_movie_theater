<?php session_start(); ?>
<?php
if (!empty($_SESSION['movie_work_id'])) unset($_SESSION['movie_work_id']);
if (!empty($_SESSION['name'])) unset($_SESSION['name']);
if (!empty($_SESSION['url'])) unset($_SESSION['url']);
if (!empty($_SESSION['movie_plan_id'])) unset($_SESSION['movie_plan_id']);
if (!empty($_SESSION['date_time'])) unset($_SESSION['date_time']);
if (!empty($_SESSION['room_name'])) unset($_SESSION['room_name']);
if (!empty($_SESSION['seat'])) unset($_SESSION['seat']);
if (!empty($_SESSION['site_user'])) unset($_SESSION['site_user']);
?>

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
    <?php require 'nav.php';
    ?>
    <main class="main">
        <div class="main__content">
            <h1 class="content__title">ログアウトページ</h1>
            <div class="content__item">
                <p class="content__logout">ログアウトしました</p>
                <!-- ここにページ内要素、content__itemは増やしても大丈夫 -->
            </div>
        </div>
    </main>
    <!-- <footer class="footer"></footer> -->
</body>

</html>