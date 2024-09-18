<main class="article-list">
    <h1><?php echo htmlspecialchars($article->getTitle()); ?></h1>
    <section class="article-list--section">
        <p><?php echo htmlspecialchars($article->getDescription()); ?></p>
        <div>
            <?php echo $article->getContent();?>
        </div>
    </section>
</main>
