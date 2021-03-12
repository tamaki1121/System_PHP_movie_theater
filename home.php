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
    ?>
    <main class="main">
        <div class="main__content">
            <h1 class="content__title">おすすめ映画一覧</h1>
            <div class="content__item">
                <div class="content__data">
                    <h2>上映映画A</h2>
                    <!--映画ポスター　だいたい200*400ぐらい？-->
                    <a href="contents.php"><img class="content__img" src="images/" alt=""></a>
                </div>
                <div class="content__data">
                    <h2>上映映画B</h2>
                    <!--映画ポスター　だいたい200*400ぐらい？-->
                    <a href="contents.php"><img class="content__img" src="images/" alt=""></a>
                </div>
                <div class="content__data">
                    <h2>上映映画C</h2>
                    <!--映画ポスター　だいたい200*400ぐらい？-->
                    <a href="contents.php"><img class="content__img" src="images/" alt=""></a>
                </div>
            </div>
            <!-- ここにページ内要素、content__itemは増やしても大丈夫 -->
        </div>
        </div>
    </main>
    <!-- <footer class="footer"></footer> -->
</body>

</html>