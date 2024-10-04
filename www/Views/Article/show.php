<main class="article-list">
    <h1>Les articles</h1>

    <nav class="article-list--tags">
        <ul class="article-list--tags__wrapper">
            <?php
            $selectedTag = isset($_GET['tag']) ? $_GET['tag'] : 'all';
            ?>
            <li class="article-list--tags__tag"><a href="?tag=all" class="<?= ($selectedTag === 'all') ? 'article-list__active' : '' ?>">Tous</a></li>
            <?php
            $tags = [];
            foreach ($articles as $article) {
                $tag = $article->getTag();
                if (!in_array($tag, $tags)) {
                    array_push($tags, $tag);
                }
            }

            foreach ($tags as $tag): ?>
                <li><a href="?tag=<?= urlencode($tag) ?>" class="<?= ($selectedTag === $tag) ? 'article-list__active' : '' ?>"><?= htmlspecialchars($tag) ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <?php
    if (!function_exists('dateEnFrancais')) {
        function dateEnFrancais($date) {
            $jours_en = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            $jours_fr = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

            $mois_en = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            $mois_fr = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

            $formattedDate = date('l, d F Y', strtotime($date));
            $formattedDate = str_replace($jours_en, $jours_fr, $formattedDate);
            $formattedDate = str_replace($mois_en, $mois_fr, $formattedDate);

            return $formattedDate;
        }
    }
    usort($articles, function ($a, $b) {
        return strtotime($b->getCreationDate()) - strtotime($a->getCreationDate());
    });
    ?>
    <section class="article-list--section">
        <?php
        $selectedTag = isset($_GET['tag']) ? $_GET['tag'] : null;

        foreach ($articles as $article):
            if ($selectedTag && $selectedTag !== 'all' && $article->getTag() !== $selectedTag) {
                continue;
            }
            ?>
            <article class="article-list--item">
                <?php
                $articleLink = $article->getImage();
                $relativeArticleLink = str_replace($_ENV['PATH_TO_PUBLIC'], '', $articleLink);
                if (!empty($articleLink)): ?>
                    <img src="<?= $relativeArticleLink ?>" alt="<?= htmlspecialchars($article->getTitle()); ?>" class="article-list--item__image">
                <?php endif; ?>
                <span class="article-list--item__tag"><?= $article->getTag(); ?></span>
                <div class="article-list--item__content">
                    <span class="article-list--item__date"><?= dateEnFrancais($article->getCreationDate()); ?></span>
                    <h3 class="article-list--item__title">
                        <a href="/article?id=<?= $article->getId(); ?>">
                            <?= $article->getTitle(); ?>
                        </a>
                    </h3>
                    <p class="article-list--item__excerpt"><?= substr($article->getDescription(), 0, 120); ?>...</p>
                    <a href="/article?id=<?= $article->getId(); ?>" class="article-list--item__read-more">Lire la suite</a>
                </div>
            </article>
        <?php endforeach; ?>
    </section>

</main>
