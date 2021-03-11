<?php
if (!empty($_SESSION['product'])) {
?>
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
                        <?php
                        $total = 0;
                        foreach ($_SESSION['product'] as $id => $product) {
                        ?>
                            <dt>作品名</dt>
                            <dd>XXX</dd>

                            <dt>日時</dt>
                            <dd>XX年XX月XX日(X)</dd>
                            <dd>XX:XX ~ XX:XX</dd>

                            <dt>座席</dt>
                            <dd>シアター１</dd>
                            <dd><?=$seat?></dd>
                            <dd>A1</dd>

                            <dt>料金</dt>
                            <dd>1,500円</dd>
                        <?php
                        }
                        ?>

                        <form action="">
                            <button class="ok__button">完了</button>
                            <button class="back__button">戻る</button>
                        </form>
                    </dl>
                    <!-- </div> -->
                </div>
            </div>
        </main>
        <!-- <footer class="footer"></footer> -->

    </body>

    </html>
<?php
}
?>