<main class="gallery">
    <h2>Galerie</h2>
    <section class="gallery--content">
        <?php
        $galleryImages = array_filter($images, function($image) {
            return $image->isGallery() === 1;
        });
        $galleryCount = count($galleryImages);
        ?>
        <?php if (empty($galleryImages)): ?>
            <h2>Pas d'image pour le moment !</h2>
        <?php else: ?>
            <div class="gallery--classic">
                <?php foreach ($galleryImages as $index => $image): ?>
                    <?php if($image->isGallery() === 1): ?>
                        <div class="gallery--classic__item">
                            <h3 class="gallery--classic__item__title"><?= htmlspecialchars($image->getTitle()); ?></h3>
                            <?php
                            $link = $image->getLink();
                            $relativeLink = str_replace('/var/www/html/Public', '', $link);
                            ?>
                            <div class="gallery--image__container">
                                <img class="gallery--classic__item__picture" src="<?= htmlspecialchars($relativeLink); ?>" alt="<?= htmlspecialchars($image->getDescription()); ?>" data-title="<?= htmlspecialchars($image->getTitle()); ?>" data-index="<?= $index; ?>">
                                <p class="gallery--classic__item__description"><?= htmlspecialchars($image->getDescription()); ?></p>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <!-- Modal structure -->
            <div id="imageModal" class="modal">
                <span class="close">&times;</span>
                <div class="carousel">
                    <span class="prev">&#10094;</span>
                    <img class="modal-content carousel--item" id="modalImage">
                    <span class="next">&#10095;</span>
                </div>
                <div id="caption"></div>
            </div>
        <?php endif; ?>
    </section>
</main>

<script src="/js/gallery.js"></script>
