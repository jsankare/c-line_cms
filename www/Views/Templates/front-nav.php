<header>
    <nav class="navbar" style="background-color: <?= $backgroundColor ?? ''; ?>; font-family: <?= $fontStyle ?? ''; ?>">
        <?php $currentUrl = $_SERVER['REQUEST_URI']; ?>
        <div class="navbar--divLeft">
            <ul>
                <li class="navbar--li"><a class="navbar--link <?= ($currentUrl === '/') ? 'frontActive' : '' ?>" href="/">Accueil</a></li>
                <li class="navbar--li"><a class="navbar--link <?= ($currentUrl === '/articles') ? 'frontActive' : '' ?>" href="/articles">Articles</a></li>
                <li class="navbar--li"><a class="navbar--link <?= ($currentUrl === '/products/show') ? 'frontActive' : '' ?>" href="/products/show">Produits</a></li>
                <li class="navbar--li"><a class="navbar--link <?= ($currentUrl === '/gallery') ? 'frontActive' : '' ?>" href="/gallery">Galerie</a></li>

                <?php if (isset($pages) && !empty($pages)): ?>
                    <li class="navbar--li dropdown">
                        <a class="dropbtn">Pages</a>
                        <ul class="dropdown-content">
                            <?php foreach ($pages as $page): ?>
                                <?php if (!$page->getIsMain()): ?>
                                    <li class="navbar--li">
                                        <a class="navbar--link <?= ($currentUrl === '/') ? 'frontActive' : '' ?>" href="/page/<?= htmlspecialchars($page->getSlug()) ?>">
                                            <?= htmlspecialchars($page->getTitle()) ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="navbar--divRight">
            <ul>
                <?php
                function getCartItemCount() {
                    if (isset($_SESSION['user-cart']) && is_array($_SESSION['user-cart'])) {
                        $totalItems = 0;
                        foreach ($_SESSION['user-cart'] as $cartItem) {
                            $totalItems += $cartItem['quantity'];
                        }
                        return $totalItems;
                    }
                    return 0;
                }
                ?>
                <?php if (isset($_SESSION['user_status']) && $_SESSION['user_status'] > 1): ?>
                    <li class="navbar--li">
                        <a class="navbar--link <?= ($currentUrl === '/cart') ? 'frontActive' : '' ?>" href="/cart">
                            <p class="cart--count"><?= getCartItemCount() ?></p>
                            <img class="cart--logo" src="/assets/shopping-bag.svg">
                        </a>
                    </li>
                    <li class="navbar--li"><a class="navbar--link <?= ($currentUrl === '/dashboard') ? 'frontActive' : '' ?>" href="/dashboard">Dashboard</a></li>
                    <li class="navbar--li"><a class="navbar--link <?= ($currentUrl === '/profile') ? 'frontActive' : '' ?>" href="/profile">Profil</a></li>
                    <li class="navbar--li"><a class="navbar--link <?= ($currentUrl === '/contact') ? 'frontActive' : '' ?>" href="/contact">Contact</a></li>
                    <li class="navbar--li"><a class="navbar--link <?= ($currentUrl === '/logout') ? 'frontActive' : '' ?>" href="/logout">Déconnexion</a></li>
                <?php elseif (isset($_SESSION['user_status']) && $_SESSION['user_status'] <= 1): ?>
                    <li class="navbar--li">
                        <a class="navbar--link <?= ($currentUrl === '/cart') ? 'frontActive' : '' ?>" href="/cart">
                            <p class="cart--count"><?= getCartItemCount() ?></p>
                            <img class="cart--logo" src="/assets/shopping-bag.svg">
                        </a>
                    </li>
                    <li class="navbar--li"><a class="navbar--link <?= ($currentUrl === '/logout') ? 'frontActive' : '' ?>" href="/logout">Déconnexion</a></li>
                    <li class="navbar--li"><a class="navbar--link <?= ($currentUrl === '/contact') ? 'frontActive' : '' ?>" href="/contact">Contact</a></li>
                    <li class="navbar--li"><a class="navbar--link <?= ($currentUrl === '/profile') ? 'frontActive' : '' ?>" href="/profile">Profil</a></li>
                <?php else: ?>
                    <li class="navbar--li">
                        <a class="navbar--link <?= ($currentUrl === '/cart') ? 'frontActive' : '' ?>" href="/cart">
                            <p class="cart--count"><?= getCartItemCount() ?></p>
                            <img class="cart--logo" src="/assets/shopping-bag.svg">
                        </a>
                    </li>
                    <li class="navbar--li"><a class="navbar--link <?= ($currentUrl === '/register') ? 'frontActive' : '' ?>" href="/register">Inscription</a></li>
                    <li class="navbar--li"><a class="navbar--link <?= ($currentUrl === '/login') ? 'frontActive' : '' ?>" href="/login">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
