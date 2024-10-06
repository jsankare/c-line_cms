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
        <footer class="comment--section">
            <?php if (isset($_SESSION['user_status']) && $_SESSION['user_status'] > 1): ?>
            <h3 class="comment--section__title">Laissez un commentaire :</h3>
            <form class="comment--section__form" action="/comment/create" method="POST">
                <input class="comment--section__input" type="hidden" name="article_id" value="<?= $article->getId(); ?>">
                <textarea class="comment--section__textarea" name="content" placeholder="Votre commentaire..." required></textarea>
                <button class="comment--section__button" type="submit">Envoyer</button>
            </form>
            <?php else: ?>
            <h3 class="comment--section__title">Connectez vous pour laisser un commentaire !</h3>
            <?php endif ?>
            <h3 class="comment--section__subtitle">Commentaires :</h3>
            <div class="comment--wrapper">
            <?php foreach ($comments as $comment): ?>
                <?php if ($comment->getStatus() !== 0): ?>
                    <section class="comment--display">
                        <h4 class="comment--display__title" class="comment--"><?= $comment->getUserName(); ?></h4>
                        <p class="comment--display__content"><?= $comment->getContent(); ?></p>
                        <span class="comment--display__date">Le <?= $comment->getFormattedDate(); ?></span>
                    </section>
                <?php endif; ?>
            <?php endforeach; ?>
            </div>
        </footer>

    </section>
    <footer class="blog--footer">
        <a class="blog--tag" href="/articles?tag=<?= $article->getTag(); ?>" >Plus sur ce thème</a>
    </footer>
</main>
