<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>C-Line * Back Office</title>
        <meta name="description" content="Super site avec une magnifique intégration">
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/back.css">
    </head>
    <body>
        <main class="mainBack" >
            <aside class="navbar" style="" >
                <?php $currentUrl = $_SERVER['REQUEST_URI']; ?>
                <a class="navbar--logo__link" href="/">
                    <img class="navbar--logo__picture" src="/assets/logo.svg">
                </a>
                <section class="navbar--list" >
                    <div class="navbar--separator" ></div>
                    <ul class="navbar--list__links">
                        <li class="navbar--list__link"><a href="/">Aller sur le site</a></li>
                        <li class="navbar--list__link <?= ($currentUrl === '/dashboard') ? 'backActive' : '' ?>"><a href="/dashboard">Tableau de bord</a></li>
                        <li class="navbar--list__link <?= ($currentUrl === '/users/home') ? 'backActive' : '' ?>"><a href="/users/home">Utilisateurs</a></li>
                        <li class="navbar--list__link <?= ($currentUrl === '/gallery/list') ? 'backActive' : '' ?>"><a href="/gallery/list" >Bibliothèque</a></li>
                        <li class="navbar--list__link <?= ($currentUrl === '/page/home') ? 'backActive' : '' ?>"><a href="/page/home">Pages</a></li>
                        <li class="navbar--list__link <?= ($currentUrl === '/products/home') ? 'backActive' : '' ?>"><a href="/products/home">Produits</a></li>
                        <li class="navbar--list__link <?= ($currentUrl === '/article/home') ? 'backActive' : '' ?>"><a href="/article/home">Articles</a></li>
                        <li class="navbar--list__link <?= ($currentUrl === '/comments/home') ? 'backActive' : '' ?>"><a href="/comments/home">Commentaires</a></li>
                        <li class="navbar--list__link <?= ($currentUrl === '/faqs/home') ? 'backActive' : '' ?>"><a href="/faqs/home">FAQs</a></li>
                        <li class="navbar--list__link <?= ($currentUrl === '/reviews/home') ? 'backActive' : '' ?>"><a href="/reviews/home">Avis</a></li>
                    </ul>
                    <div class="navbar--separator" >
                    </div>
                    <ul class="navbar--list__links">
                        <li class="navbar--list__link <?= ($currentUrl === '/dashboard/settings') ? 'backActive' : '' ?>"><a href="/dashboard/settings">Paramètres</a></li>
                        <li class="navbar--list__link <?= ($currentUrl === '/logout') ? 'backActive' : '' ?>"><a href="/logout">Se déconnecter</a></li>
                    </ul>
                    <div class="navbar--footer">
                        <?php
                        $currentUserId = $_SESSION['user_id'];
                        $currentUser = (new \App\Models\User())->findOneById($currentUserId);

                        $status = $currentUser->getStatus();
                        $roleImage = "";

                        switch ($status) {
                            case 4:
                                $roleImage = "/assets/nav-admin.svg";
                                break;
                            case 3:
                                $roleImage = "/assets/nav-moderator.svg";
                                break;
                            case 2:
                                $roleImage = "/assets/nav-editor.svg";
                                break;
                            default:
                                header('Location: /logout');
                                exit;
                        }
                        ?>
                        <div class="footer--user">
                            <img class="footer--user__image" src="<?= $roleImage; ?>" alt="Avatar utilisateur">
                            <div class="footer--user__info">
                                <p><?= $currentUser->getFirstName() . " " . $currentUser->getLastName() ?></p>
                                <small><?= $currentUser->getStringifiedStatus(); ?></small>
                            </div>
                        </div>
                    </div>

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