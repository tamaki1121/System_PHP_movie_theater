<header class="header">
    <nav class="header__nav">
        <ul class="nav__list">
            <li class="nav__item--logo">
                <a href="home.html">
                    <img class="nav__logo-img" src="logo.png" alt="">
                </a>
            </li>
            <?php
            if (empty($_SESSION['customer'])) {
            ?>
                <li class="nav__item">
                    <a class="nav__link" href="login.php">
                        <span class="nav__link-inner">ログイン</span>
                    </a>
                </li>
            <?php
            } else {
            ?>
                <li class="nav__item">
                    <a class="nav__link" href="logout.php">
                        <span class="nav__link-inner">ログアウト</span>
                    </a>
                </li>
            <?php
            }
            ?>
            <li class="nav__item">
                <a class="nav__link" href="contents.php">
                    <span class="nav__link-inner">作品一覧</span>
                </a>
            </li>
        </ul>
    </nav>
</header>