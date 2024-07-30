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
            <div class="carousel">
                <button class="carousel--control prev">&lt;</button>
                <div class="carousel--counter">
                    <span id="current--slide">1</span> / <span id="total-slides"><?php echo $galleryCount; ?></span>
                </div>
                <div class="carousel--inner">
                    <?php foreach ($images as $index => $image): ?>
                        <?php if($image->isGallery() === 1): ?>
                            <div class="carousel--item <?php echo $index === 0 ? 'active' : ''; ?>">
                                <h3 class="gallery--item__title"><?php echo htmlspecialchars($image->getTitle()); ?></h3>
                                <?php
                                $link = $image->getLink();
                                $relativeLink = str_replace('/var/www/html/Public', '', $link);
                                ?>
                                <div class="carousel--item__picture__container">
                                    <img class="gallery--item__picture" src="<?php echo htmlspecialchars($relativeLink); ?>" alt="<?php echo htmlspecialchars($image->getDescription()); ?>">
                                </div>
                                <p class="gallery--item__description"><?php echo htmlspecialchars($image->getDescription()); ?></p>
                                <div class="separator"></div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <button class="carousel--control next">&gt;</button>
            </div>
            <div class="gallery--classic">
                <?php foreach ($images as $image): ?>
                    <?php if($image->isGallery() === 1): ?>
                        <div class="gallery--classic__item">
                            <h3 class="gallery--classic__item__title"><?php echo htmlspecialchars($image->getTitle()); ?></h3>
                            <?php
                            $link = $image->getLink();
                            $relativeLink = str_replace('/var/www/html/Public', '', $link);
                            ?>
                            <div class="gallery--image__container">
                                <img class="gallery--classic__item__picture" src="<?php echo htmlspecialchars($relativeLink); ?>" alt="<?php echo htmlspecialchars($image->getDescription()); ?>">
                            </div>
                            <p class="gallery--classic__item__description"><?php echo htmlspecialchars($image->getDescription()); ?></p>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div id="imageModal" class="modal">
                <span class="close">&times;</span>
                <img class="modal-content" id="modalImage">
                <div id="caption"></div>
            </div>
        <?php endif; ?>
    </section>
</main>
<script src="/js/gallery.js"></script>
