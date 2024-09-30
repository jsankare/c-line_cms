<main class="article-list">
    <h1>Les articles</h1>
    <section class="article-list--section">
        <?php foreach ($articles as $article): ?>
            <article class="article-list--item">
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
                ?>
                <span class="article-list--item__date"><?= dateEnFrancais($article->getCreationDate()); ?></span>
                <h3 class="article-list--item__title">
                    <a href="/article?id=<?= $article->getId(); ?>">
                        <?= $article->getTitle(); ?>
                    </a>
                </h3>
                <p class="article-list--item__excerpt"><?= substr($article->getContent(), 0, 500); ?>...</p>
                <a href="/article?id=<?= $article->getId(); ?>" class="article-list--item__read-more">Lire la suite de l'article</a>
            </article>
        <?php endforeach; ?>
    </section>
    <script src="/js/date.js"></script>
</main>
