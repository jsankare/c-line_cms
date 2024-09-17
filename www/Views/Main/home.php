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
               faire un foreach, aussi besoin d'ajouter au BO
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
          <article class="faq--dropdown">
               <h4 class="faq--dropdown__question">ma question</h4>
               <p class="faq--dropdown__answer">ma reponse</p>
          </article>
     </section>

     <footer>
          Footer a faire avec une template
     </footer>
</main>