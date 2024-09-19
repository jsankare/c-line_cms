<section class="review--wrapper">
    <h2>Menu Reviews</h2>
    <section class="review--navigation">
        <a href="/reviews/create"><img class="review--icon" src="/assets/add.svg" alt="Créer une review" ></a>
    </section>
    <ul>
        <?php if (!empty($reviews)): ?>
            <?php
            usort($reviews, function($a, $b) {
                return $a->getId() <=> $b->getId();
            });
            ?>
            <section class="review--wrapper__close" >
                <?php foreach ($reviews as $review): ?>
                    <?php $identity = $review->getFirstname() . " " . $review->getLastname(); ?>

                    <div class="review--wrapper__unit" >
                        <li>
                            <h3>Auteur</h3><p><?= $identity ?></p>
                        </li>
                        <li>
                            <h3>Position</h3><p><?= $review->getPosition(); ?></p>
                        </li>
                        <li>
                            <h3>Avis</h3><p><?= $review->getComment(); ?></p>
                        </li>
                        <li>
                            <h3>Note</h3><p><?= $review->getRating(); ?></p>
                        </li>
                        <a class="review--icon__link" href="/review/edit?id=<?php echo $review->getId(); ?>"><img class="review--icon review--icon__update" src="/assets/update.svg" ></a>
                        <a class="review--icon__link" href="/review/predelete?id=<?php echo $review->getId(); ?>"><img class="review--icon review--icon__trash" src="/assets/trash.svg" ></a>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php else: ?>
            <li>Il n'y a pas de review pour le moment !</li>
        <?php endif; ?>
    </ul>
</section>
