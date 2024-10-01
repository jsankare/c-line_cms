<section class="article--wrapper">
    <h2>Menu articles</h2>
    <section class="article--navigation">
        <a href="/article/create"><img class="article--icon" src="/assets/add.svg" alt="Créer un article" ></a>
    </section>

    <!-- Navigation par tags -->
    <nav class="article--tags">
        <ul class="article--tags__list">
            <?php
            $selectedTag = isset($_GET['tag']) ? $_GET['tag'] : 'all';
            ?>
            <li class="article--tags__item">
                <a class="article--tags__tag <?= ($selectedTag === 'all') ? 'tag--active' : '' ?>" href="?tag=all">Tous</a>
            </li>

            <?php
            $tags = [];
            foreach ($articles as $article) {
                $tag = $article->getTag();
                if (!in_array($tag, $tags)) {
                    array_push($tags, $tag);
                }
            }
            foreach ($tags as $tag): ?>
                <li class="article--tags__item">
                    <a class="article--tags__tag <?= ($selectedTag === $tag) ? 'tag--active' : '' ?>" href="?tag=<?= urlencode($tag) ?>"><?= htmlspecialchars($tag) ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <ul>
        <?php if (!empty($articles)): ?>
            <?php
            $filteredArticles = array_filter($articles, function($article) use ($selectedTag) {
                return $selectedTag === 'all' || $article->getTag() === $selectedTag;
            });
            usort($filteredArticles, function($a, $b) {
                return $a->getId() <=> $b->getId();
            });
            ?>

            <section class="article--wrapper__close" >
                <?php foreach ($filteredArticles as $article): ?>
                    <div class="article--wrapper__unit" >
                        <div class="article--infos" >
                            <li class="article--value">
                                <h3>Nom</h3><p><?php echo htmlspecialchars($article->getTitle()); ?></p>
                            </li>
                            <li class="article--value" >
                                <h3>Description</h3><p><?php echo htmlspecialchars($article->getDescription()); ?></p>
                            </li>
                            <li class="article--value" >
                                <h3>Tag</h3><p><?php echo htmlspecialchars($article->getTag()); ?></p>
                            </li>
                        </div>
                        <div class="article--content">
                            <li class="article--value" >
                                <h3>Contenu (aperçu)</h3><p class="article--content__value" ><?= $article->getContent() ?></p>
                            </li>
                        </div>
                        <a class="article--icon__link" href="/article/predelete?id=<?php echo $article->getId(); ?>"><img class="article--icon article--icon__trash" src="/assets/trash.svg" ></a>
                        <a class="article--icon__link" href="/article/edit?id=<?php echo $article->getId(); ?>"><img class="article--icon article--icon__update" src="/assets/update.svg" ></a>
                        <a class="article--icon__link" href="/comment/show?article_id=<?php echo $article->getId(); ?>"><img class="article--icon article--icon__comment" src="/assets/comment.svg" alt="Voir les commentaires liés à cet article"></a>
                    </div>
                <?php endforeach; ?>
            </section>

        <?php else: ?>
            <li>Il n'y a pas d'article pour le moment !</li>
        <?php endif; ?>
    </ul>
</section>
