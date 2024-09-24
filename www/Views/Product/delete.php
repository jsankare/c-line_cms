<h1>Suppression de produit</h1>

<h2>Attention !</h2>
<p>Vous vous appretez à supprimer le produit "<?= $product->getName()?>", continuer ?</p>
<a href="/product/delete?id=<?php echo $product->getid(); ?>" >Je suis sûr de moi et je veux supprimer ce produit</a>

<p>Vous serez ensuite redirigé vers les produits</p>