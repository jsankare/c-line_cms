<main class="blog">
    <header class="blog--header">
        <?php
        $articleLink = $article->getImage();
        $relativeArticleLink = str_replace('/var/www/html/Public', '', $articleLink);
        ?>
        <img class="blog--image" src="<?= $relativeArticleLink ?>" alt="Article Image">
        <div class="blog--overlay">
            <h1 class="blog--title"><?php echo htmlspecialchars($article->getTitle()); ?></h1>
            <p class="blog--description"><?php echo htmlspecialchars($article->getDescription()); ?></p>
        </div>
    </header>
    <section class="blog--section">
        <div class="blog--content">
            <?php echo $article->getContent();?>
        </div>
    </section>
    <footer class="blog--footer">
        <a class="blog--tag" href="/articles?tag=<?= $article->getTag(); ?>" >Plus sur ce thème</a>
    </footer>
</main>
