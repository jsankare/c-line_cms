<main class="cart">
    <section class="cart--main">
        <h1 class="cart--main__title">Votre panier</h1>
        <div class="cart--main__products">
            <?php
            if (isset($_SESSION['user-cart']) && is_array($_SESSION['user-cart']) && !empty($_SESSION["user-cart"])):
                $totalItemAmount = 0;
                $totalPriceAmount = 0;
                foreach ($_SESSION['user-cart'] as $article): ?>
                    <?php
                    $totalItemAmount += $article["quantity"];
                    $totalPriceAmount += $article["price"] * $article["quantity"];
                    ?>
                    <article class="cart--main__product">
                        <?php
                        $link = $article['image'];
                        $relativeLink = str_replace('/var/www/html/Public', '', $link);
                        ?>
                        <div class="product--picture__wrapper" >
                            <img class="product--picture__image" alt="<?= $article["name"] ?>" src="<?= htmlspecialchars($relativeLink); ?>" />
                        </div>
                        <div class="product--name__wrapper">
                            <p class="product--name__content"><?= $article['name']; ?></p>
                        </div>
                        <div class="product--quantities__wrapper">
                            <a class="product--quantities product--quantities__substract" href="/product/cartSubstraction?id=<?= $article['productId'] ?>"><img class="product--quantities" src="/assets/minus.svg"></a>
                            <input type="number" class="product--quantities__amount" value="<?= $article['quantity'] ?>" readonly />
                            <a class="product--quantities product--quantities__add" href="/product/cartAddition?id=<?= $article['productId'] ?>"><img class="product--quantities" src="/assets/plus.svg"></a>
                        </div>
                        <div>
                            <p><?= $article['price'] * $article["quantity"] ?> €</p>
                        </div>
                        <a href="/cart/remove?id=<?= $article['productId'] ?>"><img class="product--delete" src="/assets/trash.svg" alt="delete"></a>
                    </article>
                <?php endforeach; ?>
                <?php else: ?>
            <p>Le panier est vide !</p>
            <?php endif; ?>
        </div>
    </section>
    <aside class="cart--aside">
        <?php if (isset($_SESSION['user-cart']) && is_array($_SESSION['user-cart']) && !empty($_SESSION["user-cart"])): ?>
        <h2 class="cart--aside__title">Résumé de votre panier</h2>
        <hr class="cart--separator" />
        <section class="specs">
            <div class="specs--top">
                <p class="specs--top__objects">Objets : <?= $totalItemAmount ?></p>
                <p class="specs--top__price"><?= $totalPriceAmount ?> €</p>
            </div>
            <div class="specs--middle">
                <p class="specs--middle__text">Petit texte avec quelque chose</p>
            </div>
            <div class="specs--bottom">
                <?php $taxes = 7 ?>
                <span>Coût supplémentaire : + <?= $taxes ?>%</span>
                <p class="specs--bottom__ttext" >Prix total</p>
                <p class="specs--bottom__tprice"><?= round($totalPriceAmount + ($totalPriceAmount / 100 ) * $taxes, 2) ?> €</p>
            </div>
            <button class="specs--button">Envoyer</button>
        </section>
        <a class="specs--emptycart" href="/cart/reset" >Vider mon panier</a>
        <?php else: ?>
        <section class="empty--wrapper">
            <h3 class="empty--header">Il n'y a rien à voir ici</h3>
            <img class="empty--picture" alt="a rabbit saying nothing here" src="/assets/rabbit.svg">
            <a class="empty--link" href="/products/show">Retourner aux produits</a>
        </section>
        <?php endif; ?>
    </aside>
</main>
