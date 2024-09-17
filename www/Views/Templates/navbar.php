<header class="navbar" style="background-color: <?= $backgroundColor ?? ''; ?>; font-family: <?= $fontStyle ?? ''; ?>">
    <nav class="navbar" style="background-color: <?= $backgroundColor ?? ''; ?>; font-family: <?= $fontStyle ?? ''; ?>">
        <div class="navbar--divLeft">
            <a href="/">Accueil</a>
            <a href="/articles">Articles</a>
            <a href="/products/show">Produits</a>
            <a href="/gallery">Galerie</a>

            <?php if (isset($pages) && !empty($pages)): ?>
                <div class="dropdown">
                    <button class="dropbtn">Pages</button>
                    <div class="dropdown-content">
                        <?php foreach ($pages as $page): ?>
                            <?php if (!$page->getIsMain()): ?>
                                    <a href="/page/<?= htmlspecialchars($page->getSlug()) ?>"><?= htmlspecialchars($page->getTitle()) ?></a>
                                <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div class="navbar--divRight">
            <?php if (isset($_SESSION['user_status']) && $_SESSION['user_status'] > 1): ?>
                <a href="/logout">Déconnexion</a>
                <a href="/profile">Profil</a>
                <a href="/dashboard">Dashboard</a>
                <?php elseif (isset($_SESSION['user_status']) && $_SESSION['user_status'] <= 1): ?>
                <a href="/logout">Déconnexion</a>
                <a href="/profile">Profil</a>
            <?php else: ?>
                <a href="/register">Inscription</a>
                <a href="/login">Connexion</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
