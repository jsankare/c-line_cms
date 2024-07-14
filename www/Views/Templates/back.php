<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ceci est mon back</title>
        <meta name="description" content="Super site avec une magnifique intégration">
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/back.css">
    </head>
    <body>
        <main class="mainBack" >
            <aside class="navbar" style="" >
                <a class="navbar--logo__link" href="/">
                    <img class="navbar--logo__picture" src="/assets/logo.svg">
                </a>
<!--                <h3>Bonjour --><?php //echo $user->getFirstName(); ?><!--</h3>-->
                <section class="navbar--list" >
                    <ul class="navbar--list__links">
                        <li class="navbar--list__link"><a href="/">Aller sur le site</a></li>
                        <li class="navbar--list__link"><a href="/dashboard">Tableau de bord</a></li>
                        <li class="navbar--list__link"><a href="/users/home">Utilisateurs</a></li>
                        <li class="navbar--list__link"><a href="/gallery/list" >Bibliothèque</a></li>
                        <li class="navbar--list__link"><a href="/page/home">Pages</a></li>
                        <li class="navbar--list__link"><a href="/item/home">Produits</a></li>
                        <li class="navbar--list__link"><a href="/article/home">Articles</a></li>
                        <li class="navbar--list__link"><a href="/comments/home">Commentaires</a></li>
                    </ul>
                    <ul class="navbar--list__links">
                        <li class="navbar--list__link"><a href="/dashboard/settings">Paramètres</a></li>
                        <li class="navbar--list__link"><a href="/logout">Se déconnecter</a></li>
                    </ul>
                </section>
            </aside>
            <section class="content" >
                <!-- intégration de la vue -->
                <?php include "../Views/".$this->view.".php";?>
            </section>
        </main>
        <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/quill-image-resize-module/3.0.0/image-resize.min.js"></script>
        <script src="/js/quill.js"></script>
    </body>
</html>