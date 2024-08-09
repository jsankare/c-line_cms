<main class="product">
    <h2>Produits</h2>
    <section class="product--section">
        <div class="product--section__tags">
            <form method="GET" class="form--products__filter">
                <label for="filter">Filtrer par :</label>
                <select name="filter" id="filter" onchange="this.form.submit()">
                    <option value="">Sélectionner une catégorie</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->getName(); ?>"
                            <?php if (isset($_GET['filter']) && $_GET['filter'] == $category->getId()) echo 'selected'; ?>>
                            <?= $category->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
        <div class="product--section__list">
            <?php foreach ($products as $product): ?>
                <?php
                if (!isset($_GET['filter']) || $_GET['filter'] == '' || $_GET['filter'] == $product->getCategory()):
                    $productLink = $product->getImage();
                    $relativeProductLink = str_replace('/var/www/html/Public', '', $productLink);
                    ?>
                    <article class="product--article">
                        <img class="product--article__image" src="<?php echo $relativeProductLink; ?>" alt="Product Image">
                        <div class="product--article__text">
                            <p class="product--article__text--name"><?= $product->getName(); ?></p>
                            <p class="product--article__text--price"><?= $product->getPrice(); ?>€</p>
                        </div>
                    </article>
                    <button class="product--button">Ajouter au panier</button>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>
</main>
