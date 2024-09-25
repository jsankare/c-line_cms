<main class="page--wrapper" >
     <section class="hero">
          <h1 class="hero--title" >Headline that highlights the Value Proposition</h1>
          <p class="hero--text">Describe exactly what your product or service does and how it makes your customer’s lives better. Avoid using verbose words or phrases.</p>
          <div class="hero-buttons">
               <a class="hero-button__primary hero-button" href="#">Get started</a>
               <a class="hero-button__secondary hero-button" href="#">Learn more</a>
          </div>
     </section>

     <section class="image--section">
          <img class="image--section__image" src="/images/landing-hero.jpg" alt="Placeholder image">
     </section>

     <section class="features">
          <?php foreach($features as $feature): ?>
               <article class="features--feature">
                    <aside class="features--feature__aside">
                         <h3 class="features--feature__title"><?= htmlspecialchars($feature['title']); ?></h3>
                         <p class="features--feature__text"><?= htmlspecialchars($feature['description']); ?></p>
                         <ul class="features--feature__list">
                              <?php foreach($feature['features'] as $item): ?>
                                   <li>⚈ <?= htmlspecialchars($item); ?></li>
                              <?php endforeach; ?>
                         </ul>
                        <a class="features--feature__link" href=<?= htmlspecialchars($feature['link']); ?>><?= htmlspecialchars($feature['ctaContent']); ?></a>
                    </aside>
                    <div class="features--feature__container">
                         <img class="features--feature__picture" src="<?= htmlspecialchars($feature['imageSrc']); ?>" alt="<?= htmlspecialchars($feature['imageAlt']); ?>">
                    </div>
               </article>
        <?php endforeach; ?>
     </section>

    <section class="reviews">
        <h2 class="reviews--title">Ma section avec les avis des gens</h2>
        <p class="reviews--text">lorem ipsum Elle est particulièrement utile pour les animations fluides de type accordion ou dropdown où l'on souhaite que l'élément s'ajuste dynamiquement à la taille de son contenu.</p>

        <div class="reviews--container">
            <button class="reviews--nav previous"> < </button>
            <div class="reviews--slider">
                <?php foreach ($reviews as $review): ?>
                    <article class="review">
                        <header class="review--rating">
                            <?php
                            $max = $review->getRating();
                            for ($i = 0; $i < $max; $i++) echo "★";
                            for ($j = $i; $j < 5; $j++) echo "☆";
                            ?>
                        </header>
                        <div class="review--container">
                            <p class="review--message">"<?= $review->getComment(); ?>"</p>
                            <footer class="review--footer">
                                <?php $identity = $review->getFirstname() . " " . $review->getLastname(); ?>
                                <p class="review--identity"><?= $identity ?></p>
                                <p class="review--position"><?= $review->getPosition(); ?></p>
                            </footer>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            <button class="reviews--nav next"> > </button>
        </div>
    </section>


     <section class="call-to-action">
          <div class="call-to-action--heading">
               <h1 class="call-to-action--title">Call to action that excites the visitor to try your product</h1>
               <p class="call-to-action--text ">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse varius enim in eros elementum tristique.</p>
          </div>
           <a href="" class="call-to-action--button">Voir les produits</a>
     </section>

     <section class="faq">
         <div class="faq--heading">
             <h1 class="faq--title">titre FAQ</h1>
             <p class="faq--text">C'est bien de poser des questions, c'est encore mieux de se poser des questions. Et le must, c'est encore de lire les FAQ quand il y en a !</p>
         </div>
         <div class="faq--wrapper">
             <?php foreach ($faqs as $faq): ?>
                 <article class="faq--dropdown">
                     <h4 class="faq--dropdown__question question"><?= $faq->getQuestion(); ?></h4>
                     <p class="faq--dropdown__answer"><?= $faq->getAnswer(); ?></p>
                 </article>
             <?php endforeach; ?>
         </div>
     </section>
    <script src="/js/faq.js"></script>
    <script src="/js/testimonial.js"></script>
</main>