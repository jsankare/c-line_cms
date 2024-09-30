<main class="article-list">
    <h1>Les articles</h1>

    <!-- Placeholder for category filter -->
    <nav class="article-list--tags">
        <ul>
            <li><a href="#">Tout</a></li>
            <li><a href="#">Couture</a></li>
            <li><a href="#">Flockage</a></li>
            <li><a href="#">Crafts</a></li>
            <li><a href="#">Naturel</a></li>
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
    ?>

    <section class="article-list--section">
        <?php foreach ($articles as $article): ?>
            <article class="article-list--item">
                <!-- Placeholder for image -->
                <!-- Add IF statement to check if image or no -->
                <img src="https://via.placeholder.com/600x400" alt="<?= $article->getTitle(); ?>" class="article-list--item__image">

                <div class="article-list--item__content">
                    <span class="article-list--item__date"><?= dateEnFrancais($article->getCreationDate()); ?></span>
                    <h3 class="article-list--item__title">
                        <a href="/article?id=<?= $article->getId(); ?>">
                            <?= $article->getTitle(); ?>
                        </a>
                    </h3>
                    <p class="article-list--item__excerpt"><?= substr($article->getContent(), 0, 120); ?>...</p>
                    <a href="/article?id=<?= $article->getId(); ?>" class="article-list--item__read-more">Lire la suite</a>
                </div>
            </article>
        <?php endforeach; ?>
    </section>
</main>
