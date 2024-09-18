<main class="product">
    <h2>Produits</h2>
    <section class="product--section">
        <div class="product--section__tags">
            <form method="GET" class="form--products__filter">
                <label for="filter">Filtrer par :</label>
                <select name="filter" id="filter" onchange="this.form.submit()">
                    <option value="all" <?php if (!isset($_GET['filter']) || $_GET['filter'] == 'all') echo 'selected'; ?>>
                        Toutes les catégories
                    </option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category->getName(); ?>"
                            <?php if (isset($_GET['filter']) && $_GET['filter'] == $category->getId()) echo 'selected'; ?>>
                            <?= $category->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                    <?php if (isset($_GET['filter']) && $_GET['filter'] != 'all'): ?>
                        <p>Filtré par : <?= htmlspecialchars($_GET['filter']); ?> </p>
                    <?php endif; ?>
                <button type="button" class="reset-button" onclick="window.location.href='?filter=all'">
                    Réinitialiser le filtre
                </button>
            </form>
        </div>


        <div class="product--section__list">
            <?php
            $selectedFilter = isset($_GET['filter']) ? $_GET['filter'] : 'all';
            
            foreach ($products as $product):
                if ($selectedFilter == 'all' || $selectedFilter == $product->getCategory()):
                    $productLink = $product->getImage();
                    $relativeProductLink = str_replace('/var/www/html/Public', '', $productLink);
                    ?>
                    <article class="product--article">
                        <div>
                            <img class="product--article__image" src="<?php echo $relativeProductLink; ?>" alt="Product Image">
                        </div>
                        <div class="product--article__text">
                            <p class="product--article__text--name"><?= $product->getName(); ?></p>
                            <p class="product--article__text--price"><?= $product->getPrice(); ?> €</p>
                        </div>
                        <div>
                            <button class="product--button">Voir plus</button>
                            <button class="product--button">Ajouter au panier</button>
                        </div>
                    </article>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>
</main>
