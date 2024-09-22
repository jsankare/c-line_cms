<header>
    <nav class="navbar" style="background-color: <?= $backgroundColor ?? ''; ?>; font-family: <?= $fontStyle ?? ''; ?>">
        <div class="navbar--divLeft">
            <ul>
                <li class="navbar--li"><a class="navbar--link" href="/">Accueil</a></li>
                <li class="navbar--li"><a class="navbar--link" href="/articles">Articles</a></li>
                <li class="navbar--li"><a class="navbar--link" href="/products/show">Produits</a></li>
                <li class="navbar--li"><a class="navbar--link" href="/gallery">Galerie</a></li>

                <?php if (isset($pages) && !empty($pages)): ?>
                    <li class="navbar--li dropdown">
                        <a class="dropbtn">Pages</a>
                        <ul class="dropdown-content">
                            <?php foreach ($pages as $page): ?>
                                <?php if (!$page->getIsMain()): ?>
                                    <li class="navbar--li">
                                        <a class="navbar--link" href="/page/<?= htmlspecialchars($page->getSlug()) ?>">
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
                        <a class="navbar--link" href="/cart">
                            <p class="cart--count"><?= getCartItemCount() ?></p>
                            <img class="cart--logo" src="/assets/shopping-bag.svg">
                        </a>
                    </li>
                    <li class="navbar--li"><a class="navbar--link" href="/dashboard">Dashboard</a></li>
                    <li class="navbar--li"><a class="navbar--link" href="/profile">Profil</a></li>
                    <li class="navbar--li"><a class="navbar--link" href="/contact">Contact</a></li>
                    <li class="navbar--li"><a class="navbar--link" href="/logout">Déconnexion</a></li>
                <?php elseif (isset($_SESSION['user_status']) && $_SESSION['user_status'] <= 1): ?>
                    <li class="navbar--li">
                        <a class="navbar--link" href="/cart">
                            <p class="cart--count"><?= getCartItemCount() ?></p>
                            <img class="cart--logo" src="/assets/shopping-bag.svg">
                        </a>
                    </li>
                    <li class="navbar--li"><a class="navbar--link" href="/logout">Déconnexion</a></li>
                    <li class="navbar--li"><a class="navbar--link" href="/contact">Contact</a></li>
                    <li class="navbar--li"><a class="navbar--link" href="/profile">Profil</a></li>
                <?php else: ?>
                    <li class="navbar--li"><a class="navbar--link" href="/register">Inscription</a></li>
                    <li class="navbar--li"><a class="navbar--link" href="/login">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>
