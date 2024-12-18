<?php
$footerStyles = 'style="background-color: ' . ($backgroundColor ?? '') . '; font-family: ' . ($fontStyle ?? '') . ';"';
?>

<footer <?= $footerStyles ?> class="footer">
    <?php
    $pages = (new \App\Models\Page())->findAll();
    ?>
    <header class="footer--header">
        <section class="footer--left">
            <div class="footer--logo">
                <a class="footer--logo__link" href="/">
                    <img class="footer--logo__picture" src="/assets/logo.svg">
                </a>
            </div>
            <div class="footer--left__top">
                <h4>Contact</h4>
                <a href="#mailto">monmail@mail.com</a>
            </div>
            <div>
                <ul class="footer--left__list">
                    <?php
                    $socials = ["facebook" => "toto", "instagram"=> "toto", "twitter"=> "tototwitter"];
                    foreach ($socials as $social => $link): ?>
                        <li class="footer--left__item">
                            <a class="footer--left__itemLink" href="<?= $link ?>">
                                <img class="footer--left__logo" src="/assets/<?= $social ?>.svg">
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>

        <section class="footer--right">
            <div class="footer--right__wrapper">
                <?php if (!empty($pages)): ?>
                    <h3 class="footer--right__title">Liste des pages :</h3>
                    <ul class="footer--right__list">
                        <li class="footer--right__listItem">
                            <a class="footer--right__listItemLink" href="/">Accueil</a>
                        </li>
                        <li class="footer--right__listItem">
                            <a class="footer--right__listItemLink" href="/articles">Articles</a>
                        </li>
                        <li class="footer--right__listItem">
                            <a class="footer--right__listItemLink" href="/products/show">Produits</a>
                        </li>
                        <li class="footer--right__listItem">
                            <a class="footer--right__listItemLink" href="/gallery">Galerie</a>
                        </li>
                        <?php foreach ($pages as $page): ?>
                            <li class="footer--right__listItem">
                                <a class="footer--right__listItemLink" href="/page/<?= $page->getSlug(); ?>"><?= $page->getTitle(); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </section>
    </header>

    <footer class="footer--footer">
        <span class="footer--footer__span">Creation <a class="footer--footer__link" href="https://www.jsankare.dev/">Jordan Sankare</a> 2024</span>
    </footer>
</footer>
