
<?php session_start(); ?>

<?php 
    if(isset($_POST['seat'])){
        $_SESSION['seat'] = $_POST['seat'];
    }
?>

<!DOCTYPE html>
    <html lang="jp">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="css/watanabe.css" />
        <title>購入確認</title>
    </head>

    <body>
    <?php
    require 'nav.php';
    ?>
        <main class="main">
            <div class="main__content">
                <h1 class="content__title">購入内容</h1>
                <div class="content__item">
                    <!-- ここにページ内要素、content__itemは増やしても大丈夫 -->
                    
                    <img src="imges/<?= $_SESSION['url'] ?>" class="item__img" />

                    <!-- <div class="content__confirm"> -->
                    <dl class="content__confirm__list">
                            <dt>作品名</dt>
                            <dd><?= $_SESSION['name']?></dd>

                            <dt>日時</dt>
                            <dd><?=$_SESSION['date_time']?></dd>

                            <dt>座席</dt>       
                            <?php
                            foreach($_SESSION['seat'] as $val){
                                echo "<dd>",$val,"</dd>";
                            }
                            ?>

                            <dt>料金</dt>
                            <dd><?= count($_SESSION['seat'] * 1000)?>円</dd>

                            <button class="ok__button" onclick="seat_success.php">完了</button>
                            <button class="back__button" onclick="seat.php">戻る</button>
                    </dl>
                    <!-- </div> -->
                </div>
            </div>
        </main>
        <!-- <footer class="footer"></footer> -->

    </body>
    </html>