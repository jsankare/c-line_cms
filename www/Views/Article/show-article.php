<main class="blog">
    <header class="blog--header">
        <?php
        $articleLink = $article->getImage();
        $relativeArticleLink = str_replace($_ENV['PATH_TO_PUBLIC'], '', $articleLink);
        if (!function_exists('dateEnFrancais')) {
            function dateEnFrancais($date) {
                $jours_en = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                $jours_fr = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];

                $mois_en = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                $mois_fr = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];

                $formattedDate = date('l d F Y', strtotime($date));
                $formattedDate = str_replace($jours_en, $jours_fr, $formattedDate);
                $formattedDate = str_replace($mois_en, $mois_fr, $formattedDate);

                return $formattedDate;
            }
        }
        ?>
        <img class="blog--image" src="<?= $relativeArticleLink ?>" alt="Article Image">
        <div class="blog--overlay">
            <h1 class="blog--title"><?php echo htmlspecialchars($article->getTitle()); ?></h1>
            <p class="blog--description"><?php echo htmlspecialchars($article->getDescription()); ?></p>
            <span>Le <?= dateEnFrancais($article->getCreationDate()); ?></span>
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
