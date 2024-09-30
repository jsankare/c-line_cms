<main class="item">
    <section class="item--main">
        <article class="item--main__wrapper">
            <?php
                $link = $product->getImage();
                $relativeLink = str_replace('/var/www/html/Public', '', $link);
            ?>
            <img src="<?= htmlspecialchars($relativeLink); ?>" alt="" class="item--main__image">
        </article>
    </section>
    <aside class="item--aside">
        <header class="item--aside__intel">
            <h2 class="item--aside__intel__heading"><?= $product->getName(); ?></h2>
            <div class="item--aside__intel__rating">
            ☆☆☆☆☆ (2 avis)
            </div>
            <?php if ($product->getAvailable() === 1): ?>
            <div class="item--aside__intel__pricing">
                <p class="item--aside__intel__price"><?= $product->getPrice(); ?> €</p>
            </div>
            <?php else: ?>
                <div class="item--aside__intel__pricing">
                <p style="text-decoration-line: line-through;" class="item--aside__intel__price__unavailable"><?= $product->getPrice(); ?> €</p>
            </div>
            <?php endif ?>
        </header>
        <section class="item--aside__interactions">
        <?php if ($product->getAvailable() === 1): ?>
            <form action="" class="item--aside__interactions__form">
                <label for="quantity-item" class="item--aside__interactions__label">Quantité</label>
                <select name="quantities" id="quantity-item" class="item--aside__interactions__input">
                <option value="">Choisir une quantité</option>
                <option value="dog">1</option>
                <option value="cat">2</option>
                <option value="hamster">3</option>
                <option value="parrot">4</option>
                <option value="spider">...</option>
                </select>
                <button class="item--aside__interactions__submit">Ajouter au panier</button>
            </form>
        <?php else: ?>
            <form aria-disabled="true" action="" class="item--aside__interactions__form">
                <label for="quantity-item" class="item--aside__interactions__label">Quantité</label>
                <select disabled name="quantities" id="quantity-item" class="item--aside__interactions__input">
                    <option value="">Choisir une quantité</option>
                    <option value="dog">1</option>
                    <option value="cat">2</option>
                    <option value="hamster">3</option>
                    <option value="parrot">4</option>
                    <option value="spider">...</option>
                </select>
                <button disabled style="background-color: #6e1c1c" class="item--aside__interactions__submit">Non disponible</button>
            </form>
        <?php endif ?>
        </section>
        <footer class="item--aside__text">
            <p class="item--aside__text__content"><?= $product->getDescription(); ?></p>
        </footer>
    </aside>
</main>