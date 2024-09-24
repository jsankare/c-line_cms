<section class="product--wrapper">
    <h2>Menu Produits</h2>
    <section class="product--navigation">
        <a href="/products/create"><img class="product--icon" src="/assets/add.svg" alt="Créer un produit" ></a>
    </section>
    <ul>
        <?php if (!empty($products)): ?>
            <?php
            usort($products, function($a, $b) {
                return $a->getId() <=> $b->getId();
            });
            ?>
            <section class="product--wrapper__close" >
            <?php foreach ($products as $product): ?>
            <div class="product--wrapper__unit" >
                <div class="product--infos" >
                    <li class="product--value">
                        <h3>Nom</h3><p><?php echo htmlspecialchars($product->getName()); ?></p>
                    </li>
                    <li class="product--value" >
                        <h3>Catégorie</h3><p><?php echo htmlspecialchars($product->getCategory()); ?></p>
                    </li>
                    <li class="product--value" >
                        <h3>Prix</h3><p><?php echo htmlspecialchars($product->getPrice()); ?>€</p>
                    </li>
                    <li class="product--value" >
                        <h3>Disponibilité</h3><p><?php if ($product->getAvailable()) echo "Oui"; else echo "Non"; ?></p>
                    </li>
                </div>
                <div class="product--content">
                    <li class="product--value" >
                        <h3>Description</h3><p class="product--content__value" ><?= $product->getDescription() ?></p>
                    </li>
                </div>
                <a class="product--icon__link" href="/product/predelete?id=<?php echo $product->getId(); ?>"><img class="product--icon product--icon__trash" src="/assets/trash.svg" ></a>
                <a class="product--icon__link" href="/product/edit?id=<?php echo $product->getId(); ?>"><img class="product--icon product--icon__update" src="/assets/update.svg" ></a>
            </div>
            <?php endforeach; ?>
            </section>
        <?php else: ?>
            <li>Il n'y a pas de produit pour le moment !</li>
        <?php endif; ?>
    </ul>
</section>
