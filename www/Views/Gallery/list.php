<section class="gallery" >
    <h2>Galerie des images</h2>
    <section class="gallery--navigation">
        <a href="/gallery/create"><img class="gallery--icon" src="/assets/add-image.svg" alt="Ajouter une image" ></a>
    </section>
    <?php if (!empty($images)): ?>
        <div class="gallery--content">
            <?php foreach ($images as $image): ?>
                <div class="gallery--content__item">
                    <h3 class="gallery--item__title" ><?php echo htmlspecialchars($image->getTitle()); ?></h3>
                    <?php
                    $link = $image->getLink();
                    $relativeLink = str_replace('/var/www/html/www/Public', '', $link);
                    ?>
                    <img class="gallery--item__picture" src="<?php echo htmlspecialchars($relativeLink); ?>" alt="<?php echo htmlspecialchars($image->getDescription()); ?>">
                    <p class="gallery--item__description"><?php echo htmlspecialchars($image->getDescription()); ?></p>
                    <div class="gallery--item__icons">
                        <a class="gallery--icon__link" href="/image/edit?id=<?php echo $image->getId(); ?>"><img class="gallery--icon gallery--icon__update" src="/assets/update.svg" ></a>
                        <a class="gallery--icon__link" href="/image/predelete?id=<?php echo $image->getId(); ?>"><img class="gallery--icon gallery--icon__trash" src="/assets/trash.svg" ></a>
                    </div>
                    <div class="separator"></div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <h2 class="gallery--notFound">Aucune image trouvée.</h2>
    <?php endif; ?>
</section>
