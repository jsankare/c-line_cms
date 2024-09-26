<footer class="footer">
    <?php
    $pages = (new \App\Models\Page())->findAll();
    ?>
    <header class="footer--header">
        <section class="footer--left">
            <div class="footer--logo">
                <a class="footer--logo__link" href="/"><img class="footer--logo__picture" src="/assets/logo.svg"></a>
            </div>
            <div>
                <h4>Contact</h4>
                <a href="#mailto">monmail@mail.com</a>
            </div>
            <div>
                <ul>
                    <li>facebook</li>
                    <li>instagram</li>
                    <li>twitter</li>
                </ul>
            </div>
        </section>
        <section class="footer--right">
            <div>
                <?php if (!empty($pages)): ?>
                <h3>Piste des pages :</h3>
                    <ul>
                        <?php foreach ($pages as $page): ?>
                            <li>
                                <a href="/page/<?= $page->getSlug(); ?>"><?= $page->getTitle(); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </section>
    </header>
    <footer class="footer--footer">

    </footer>

</footer>