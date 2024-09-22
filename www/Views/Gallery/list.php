<section class="gallery">
    <h2>Galerie des images</h2>
    <section class="gallery--navigation">
        <a href="/gallery/create"><img class="gallery--icon" src="/assets/add-image.svg" alt="Ajouter une image"></a>
    </section>

    <form method="GET" class="form--gallery__filter">
        <label for="filter">Filtrer par :</label>
        <select name="filter" id="filter" onchange="this.form.submit()">
            <option value="all" <?= (!isset($_GET['filter']) || $_GET['filter'] == 'all') ? 'selected' : ''; ?>>Toutes les images</option>
            <option value="gallery" <?= (isset($_GET['filter']) && $_GET['filter'] == 'gallery') ? 'selected' : ''; ?>>Images de la galerie</option>
            <option value="non-gallery" <?= (isset($_GET['filter']) && $_GET['filter'] == 'non-gallery') ? 'selected' : ''; ?>>Images hors galerie</option>
        </select>
    </form>

    <?php
    $filter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
    $filteredImages = array_filter($images, function($image) use ($filter) {
        if ($filter == 'gallery') {
            return $image->isGallery() === 1;
        } elseif ($filter == 'non-gallery') {
            return $image->isGallery() === 0;
        }
        return true;
    });
    ?>

    <?php if (!empty($filteredImages)): ?>
        <div class="gallery--content">
            <?php foreach ($filteredImages as $image): ?>
                <div class="gallery--content__item">
                    <?php
                    $link = $image->getLink();
                    $relativeLink = str_replace('/var/www/html/Public', '', $link);
                    ?>
                    <img class="gallery--item__picture" src="<?= htmlspecialchars($relativeLink); ?>" alt="<?= htmlspecialchars($image->getDescription()); ?>">

                    <div class="gallery--item__info">
                        <h3 class="gallery--item__title"><?= htmlspecialchars($image->getTitle()); ?></h3>
                        <p class="gallery--item__description"><?= htmlspecialchars($image->getDescription()); ?></p>
                    </div>

                    <div class="gallery--item__icons">
                        <a class="gallery--icon__link" href="/image/edit?id=<?= $image->getId(); ?>"><img class="gallery--icon gallery--icon__update" src="/assets/update.svg"></a>
                        <a class="gallery--icon__link" href="/image/predelete?id=<?= $image->getId(); ?>"><img class="gallery--icon gallery--icon__trash" src="/assets/trash.svg"></a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <h2 class="gallery--notFound">Aucune image trouvée.</h2>
    <?php endif; ?>
</section>
