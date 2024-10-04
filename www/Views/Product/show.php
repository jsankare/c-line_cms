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

            $availableProducts = [];
            $unavailableProducts = [];

            foreach ($products as $product) {
                if ($selectedFilter == 'all' || $selectedFilter == $product->getCategory()) {
                    if ($product->getAvailable() == 1) {
                        $availableProducts[] = $product;
                    } else {
                        $unavailableProducts[] = $product;
                    }
                }
            }

            function displayProduct($product) {
                $productLink = $product->getImage();
                $relativeProductLink = str_replace($_ENV['PATH_TO_PUBLIC'], '', $productLink);
                $productId = $product->getId();
                ?>
                <article class="product--article">
                    <div class="product--image">
                        <img class="product--article__image" src="<?= $relativeProductLink; ?>" alt="Product Image">
                        <?php if ($product->getAvailable() === 0): ?>
                        <div class="product--article__headband">Non disponible</div>
                        <?php endif; ?>
                    </div>
                    <div class="product--article__text">
                        <p class="product--article__text--name"><?= $product->getName(); ?></p>
                        <p class="product--article__text--price"><?= $product->getPrice(); ?> €</p>
                    </div>
                    <div>
                        <a href="/product/showone?id=<?= $product->getId(); ?>" class="product--button">Voir plus</a>
                        <?php
                        if(isset($_SESSION["user-cart"])) $userCart = $_SESSION["user-cart"];
                        if (isset($userCart[$productId])) {
                            $quantity = $userCart[$productId]['quantity'];
                            ?>
                            <div class="product--quantities__wrapper">
                                <a class="product--quantities product--quantities__substract" href="/product/displaySubstraction?id=<?= $productId; ?>"><img class="product--quantities" src="/assets/minus.svg"></a>
                                <input readonly type="number" class="product--quantities__amount" value="<?= $quantity ?>"/>
                                <a class="product--quantities product--quantities__add" href="/product/displayAddition?id=<?= $productId; ?>"><img class="product--quantities" src="/assets/plus.svg"></a>
                            </div>
                        <?php } else { ?>
                            <div>
                                <?php if ($product->getAvailable() === 1): ?>
                                <a href="/product/add?id=<?= $productId; ?>" class="product--button">Ajouter au panier</a>
                                <?php else: ?>
                                    <p class="product--button product--button__disabled">Non disponible</p>
                                <?php endif; ?>
                            </div>
                        <?php } ?>
                    </div>
                </article>
                <?php
            }

            foreach ($availableProducts as $product) {
                displayProduct($product);
            }

            foreach ($unavailableProducts as $product) {
                displayProduct($product);
            }
            ?>
        </div>
    </section>
</main>
