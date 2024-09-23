<main class="cart">
    <section class="cart--main">
        <h1 class="cart--main__title">Votre panier</h1>
        <div class="cart--main__products">
            <?php
            if (isset($_SESSION['user-cart']) && is_array($_SESSION['user-cart'])):
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
                        <div class="product--quantities__wrapper" >
                            <a class="product--quantities__add" href="/product/addition?id=<?php echo $article["id"] ?>">-</a>
                            <input type="number" class="product--quantities__amount" value="<?= $article['quantity'] ?>" />
                            <a class="product--quantities__substract" href="#">+</a>
                        </div>
                        <div>
                            <p><?= $article['price'] * $article["quantity"] ?> €</p>
                        </div>
                        <img class="product--delete" src="/assets/trash.svg" alt="delete">
                    </article>
                <?php endforeach; ?>
                <?php else: ?>
            <p>Le panier est vide !</p>
            <?php endif; ?>
        </div>
    </section>
    <aside class="cart--aside">
        <?php if (isset($_SESSION['user-cart']) && is_array($_SESSION['user-cart'])): ?>
        <h2>Résumé de votre panier</h2>
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
                <p class="specs--bottom__ttext" >Prix total</p>
                <p class="specs--bottom__tprice"><?= round($totalPriceAmount + ($totalPriceAmount / 100 ) * $taxes, 2) ?> €</p>
            </div>
            <button>Envoyer</button>
        </section>
        <a href="/cart/reset" >Reset cart</a>
        <?php else: ?>
        <p>Panier vide !</p>
        <?php endif; ?>
    </aside>
</main>
