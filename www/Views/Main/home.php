<main class="page--wrapper" >
     <section class="hero">
          <h1 class="hero--title" >Headline that highlights the Value Proposition</h1>
          <p class="hero--text">Describe exactly what your product or service does and how it makes your customer’s lives better. Avoid using verbose words or phrases.</p>
          <div class="hero-buttons">
               <a class="hero-buttons__button" href="#">Get started</a>
               <a class="hero-buttons__button" href="#">Learn more</a>
          </div>
     </section>

     <section class="image-section">
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
                                   <li><?= htmlspecialchars($item); ?></li>
                              <?php endforeach; ?>
                         </ul>
                    </aside>
                    <div class="features--feature__container">
                         <img class="features--feature__picture" src="<?= htmlspecialchars($feature['imageSrc']); ?>" alt="<?= htmlspecialchars($feature['imageAlt']); ?>">
                         <a href=<?= htmlspecialchars($feature['link']); ?>><?= htmlspecialchars($feature['ctaContent']); ?></a>
                    </div>
               </article>
        <?php endforeach; ?>
     </section>


     <section class="reviews">
          <h3 class="reviews--title">Reviews</h3>
          <p class="reviews--text">text</p>
          <div class="reviews--container">
              <?php foreach ($reviews as $review): ?>
                <article class="review--wrapper" >
                    <header class="review--rating">
                        <?php
                        $max = $review->getRating();
                        for ($i = 0; $i < $max; $i++) echo "★";
                        for ($j = $i; $j < 5; $j++) echo "☆";
                        ?>
                    </header>
                    <p class="review--message"><?= $review->getComment(); ?></p>
                    <footer class="review--footer" >
                        <?php $identity = $review->getFirstname() . " " . $review->getLastname(); ?>
                        <p class="review--identity"><?= $identity ?></p>
                        <p class="review--position"><?= $review->getPosition(); ?></p>
                    </footer>
                </article>
              <?php endforeach; ?>
          </div>
     </section>

     <section class="call-to-action">
          <div class="call-too-action--heading">
               <h1 class="call-too-action--title">cta title</h1>
               <p class="call-too-action--text">cta text</p>
          </div>
          <div class="call-too-action--buttons">
               <a href="" class="call-too-action--buttons__unit">btn 1</a>
               <a href="" class="call-too-action--buttons__unit">btn 2</a>
          </div>
     </section>

     <section class="faq">
          <h1 class="faq--title">titre FAQ</h1>
          <p class="faq--text">exemple de texte pour la FAQ</p>
         <?php foreach ($faqs as $faq): ?>
             <article class="faq--dropdown">
                 <h4 class="faq--dropdown__question"><?= $faq->getQuestion(); ?></h4>
                 <p class="faq--dropdown__answer"><?= $faq->getAnswer(); ?></p>
             </article>
         <?php endforeach; ?>
     </section>

     <footer>
          Footer a faire avec une template
     </footer>
</main>