
<?php session_start(); ?>
<!DOCTYPE html>
    <html lang="jp">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="css/style.css" />
        <title>購入確認</title>
    </head>

    <body>
        <header class="header">
            <nav class="header__nav">
                <ul class="nav__list">
                    <li class="nav__item--logo">
                        <a href=""></a>
                        <img class="nav__logo-img" src="image/logo.png" alt="" />
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
                <h1 class="content__title">購入内容</h1>
                <div class="content__item">
                    <!-- ここにページ内要素、content__itemは増やしても大丈夫 -->

                    <img src="img/movie_img1.jpg" class="item__img" />
                    <!-- <div class="content__confirm"> -->
                    <dl class="content__confirm__list">
                            <dt>作品名</dt>
                            <dd><?php echo $_SESSION['name']?></dd>

                            <dt>日時</dt>
                            <dd><?php echo$_SESSION['date_time']?></dd>

                            <dt>座席</dt>

                            <?php
                            if(isset($_POST['room_name'])){
                                $_SESSION['room_name'];
                            }

                            if(isset($_POST['seat_id'])){
                                $_SESSION['seat_id'];
                            }
                            $room_name = ($_SESSION['room_name']);
                            $seat_id = ($_SESSION['seat_id']);
                            ?>           

                            <dd><?php echo ($room_name);?></dd>
                            <dd><?php echo ($seat_id);?></dd>
                            <dd><?php echo ($number);?></dd>

                            <dt>料金</dt>
                            <dd>1,500円</dd>

                            <button class="ok__button" onclick="">完了</button>
                            <button class="back__button" onclick="">戻る</button>
                    </dl>
                    <!-- </div> -->
                </div>
            </div>
        </main>
        <!-- <footer class="footer"></footer> -->

    </body>

    </html>
