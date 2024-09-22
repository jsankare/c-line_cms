<main class="cart">
    <section class="cart--main">
        <h1 class="cart--main__title">Votre panier</h1>
        <div class="cart--main__products">
            <?php
            if (isset($_SESSION['user-cart']) && is_array($_SESSION['user-cart'])):
                foreach ($_SESSION['user-cart'] as $article): ?>
                    <article class="cart--main__product">
                        <?php
                        $link = $article['image'];
                        $relativeLink = str_replace('/var/www/html/Public', '', $link);
                        ?>
                        <div class="product--picture__wrapper" >
                            <img class="product--picture__image" src="<?= htmlspecialchars($relativeLink); ?>" />
                        </div>
                        <div class="product--name__wrapper">
                            <p class="product--name__content"><?= $article['name']; ?></p>
                        </div>
                        <div class="product--quantities__wrapper" >
                            <a class="product--quantities__add" href="#">-</a>
                            <p class="product--quantities__amount" ><?= $article['quantity'] ?></p>
                            <a class="product--quantities__substract" href="#">+</a>
                        </div>
                        <div>
                            <p><?= $article['price'] ?> €</p>
                        </div>
                        <p>X</p>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
    <aside class="cart--aside">
        <h2>Résumé de votre panier</h2>
        <section>
            <div>
                <p>Objets : 3</p>
                <p>43 €</p>
            </div>
            <div>
                <p>Petit texte avec quelque chose</p>
            </div>
            <div>
                <p>Prix total</p>
                <p>45 €</p>
            </div>
            <button>Envoyer</button>
        </section>
        <a href="/cart/reset" >Reset cart</a>
    </aside>
</main>
