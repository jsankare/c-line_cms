<h1>Suppression de Review</h1>

<?php $identity = $review->getFirstname . " " . $review->getLastname ?>

<h2>Attention !</h2>
<p>Vous vous appretez à supprimer la review de <?= $identity ?> , continuer ?</p>
<a href="/review/delete?id=<?php echo $review->getid(); ?>" >Je suis sûr de moi et je veux supprimer la review</a>

<p>Vous serez ensuite redirigé vers les Reviews</p>