<section class="item--wrapper">
    <h2>Menu Produits</h2>
    <section class="item--navigation">
        <a href="/item/create"><img class="item--icon" src="/assets/add.svg" alt="Créer un produit" ></a>
    </section>
    <ul>
        <?php if (!empty($items)): ?>
            <?php
            usort($items, function($a, $b) {
                return $a->getId() <=> $b->getId();
            });
            ?>
            <section class="item--wrapper__close" >
            <?php foreach ($items as $item): ?>
            <div class="item--wrapper__unit" >
                <div class="item--infos" >
                    <li class="item--value">
                        <h3>Nom</h3><p><?php echo htmlspecialchars($item->getTitle()); ?></p>
                    </li>
                    <li class="item--value" >
                        <h3>Description</h3><p><?php echo htmlspecialchars($item->getDescription()); ?></p>
                    </li>
                </div>
                <div class="item--content">
                    <li class="item--value" >
                        <h3>Contenu (aperçu)</h3><p class="item--content__value" ><?= $item->getContent() ?></p>
                    </li>
                </div>
                <a class="item--icon__link" href="/item/predelete?id=<?php echo $item->getId(); ?>"><img class="item--icon item--icon__trash" src="/assets/trash.svg" ></a>
                <a class="item--icon__link" href="/item/edit?id=<?php echo $item->getId(); ?>"><img class="item--icon item--icon__update" src="/assets/update.svg" ></a>
                <a class="item--icon__link" href="/comment/show?item_id=<?php echo $item->getId(); ?>"><img class="item--icon item--icon__comment" src="/assets/comment.svg" alt="Voir les commentaires liés à cet items"></a>
            </div>
            <?php endforeach; ?>
            </section>
        <?php else: ?>
            <li>Il n'y a pas d'item pour le moment !</li>
        <?php endif; ?>
    </ul>
</section>
