<?php
if (isset($_SESSION['user-cart']) && is_array($_SESSION['user-cart'])) {
    foreach ($_SESSION['user-cart'] as $article) {
        echo '<pre>';
        var_dump($article);
        echo '</pre>';

    }
} else {
    echo "pas d'article !";
}
?>