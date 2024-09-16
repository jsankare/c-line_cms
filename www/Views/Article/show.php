<!-- src/Views/article/list.php -->
<main class="article-list">
    <h1>Les articles</h1>
    <section class="article-list--section">
        <?php foreach ($articles as $article): ?>
            <article class="article-list--item">
                <h3 class="article-list--item__title">
                    <a href="/article/show?id=<?= $article->getId(); ?>">
                        <?= $article->getTitle(); ?>
                    </a>
                </h3>
                <p class="article-list--item__excerpt"><?= substr($article->getContent(), 0, 500); ?>...</p>
                <a href="/article/show?id=<?= $article->getId(); ?>" class="article-list--item__read-more">Lire la suite de l'article</a>
            </article>
        <?php endforeach; ?>
    </section>
</main>
