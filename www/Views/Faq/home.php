<section class="faq--wrapper">
    <h2>Menu FAQs</h2>
    <section class="faq--navigation">
        <a href="/faq/create"><img class="faq--icon" src="/assets/add.svg" alt="Créer une faq" ></a>
    </section>
    <ul>
        <?php if (!empty($faqs)): ?>
            <?php
            usort($faqs, function($a, $b) {
                return $a->getId() <=> $b->getId();
            });
            ?>
            <section class="faq--wrapper__close" >
                <?php foreach ($faqs as $faq): ?>

                    <div class="faq--wrapper__unit" >
                        <li>
                            <h3>Titre</h3><p><?php echo htmlspecialchars($faq->getQuestion()); ?></p>
                        </li>
                        <li>
                            <h3>Description</h3><p><?php echo htmlspecialchars($faq->getAnswer()); ?></p>
                        </li>
                        <a class="faq--icon__link" href="/faq/edit?id=<?php echo $faq->getId(); ?>"><img class="faq--icon faq--icon__update" src="/assets/update.svg" ></a>
                        <a class="faq--icon__link" href="/faq/predelete?id=<?php echo $faq->getId(); ?>"><img class="faq--icon faq--icon__trash" src="/assets/trash.svg" ></a>
                    </div>
                <?php endforeach; ?>
            </section>
        <?php else: ?>
            <li>Il n'y a pas de faq pour le moment !</li>
        <?php endif; ?>
    </ul>
</section>
