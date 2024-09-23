<main class="product">
    <h2>Produits</h2>
    <section class="product--section">
        <div class="product--section__tags">
            <form method="GET" class="form--products__filter">
                <label class="filter--label" for="filter">Filtrer par :</label>
                <select class="filter--select" name="filter" id="filter" onchange="this.form.submit()">
                    <option class="filter--option" value="all" <?php if (!isset($_GET['filter']) || $_GET['filter'] == 'all') echo 'selected'; ?>>Toutes les catégories</option>
                    <?php foreach ($categories as $category): ?>
                        <option class="filter--option" value="<?= $category->getName(); ?>"
                            <?php if (isset($_GET['filter']) && $_GET['filter'] == $category->getId()) echo 'selected'; ?>>
                            <?= $category->getName(); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                    <?php if (isset($_GET['filter']) && $_GET['filter'] != 'all'): ?>
                        <p>Filtré par : <?= htmlspecialchars($_GET['filter']); ?> </p>
                    <?php endif; ?>
                <button type="button" class="reset--button" onclick="window.location.href='?filter=all'">Réinitialiser le filtre</button>
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
                        <div class="product--image">
                            <img class="product--article__image" src="<?php echo $relativeProductLink; ?>" alt="Product Image">
                        </div>
                        <div class="product--article__text">
                            <p class="product--article__text--name"><?= $product->getName(); ?></p>
                            <p class="product--article__text--price"><?= $product->getPrice(); ?> €</p>
                        </div>
                        <div>
                            <a href="/product/showone?id=<?= $product->getId(); ?>" class="product--button">Voir plus</a>
                            <?php
                            $productId = $product->getId();
                            if(isset($_SESSION["user-cart"])) $userCart = $_SESSION["user-cart"];
                            ?>

                            <?php if (isset($userCart[$productId])): ?>
                                <?php $quantity = $userCart[$productId]['quantity']; ?>
                            <div class="product--quantities__wrapper">
                                <a class=" product--quantitiesproduct--quantities__substract" href="/product/displaySubstraction?id=<?= $productId; ?>"><img class="product--quantities" src="/assets/minus.svg"></a>
                                <input readonly type="number" class="product--quantities__amount" value="<?= $quantity ?>"/>
                                <a class="product--quantities product--quantities__add" href="/product/displayAddition?id=<?= $productId; ?>"><img class="product--quantities" src="/assets/plus.svg"></a>
                            </div>
                            <?php else: ?>
                            <div>
                                <a href="/product/add?id=<?= $productId; ?>" class="product--button">Ajouter au panier</a>
                            </div>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </section>
</main>
