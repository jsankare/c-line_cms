<main class="profile">
    <h1 class="profile--title">Bienvenue <?= htmlspecialchars($authenticatedUser->getFirstname(), ENT_QUOTES, 'UTF-8') ?></h1>

    <section class="profile--header">
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
        <?php if ($authenticatedUser->getLastName() === "MONJARET" && $authenticatedUser->getEmail() === "vmonjaret@gmail.com"): {} ?>
        <img src="/assets/sword.svg" alt="Profile Picture" class="profile--header__avatar">
        <?php else: ?>
        <img src="<?= $roleImage ?>" alt="Profile Picture" class="profile--header__avatar">
        <?php endif; ?>
        <div class="profile--header__info">
            <h2><?= htmlspecialchars($authenticatedUser->getFirstname() . " " . $authenticatedUser->getLastname(), ENT_QUOTES, 'UTF-8') ?></h2>
            <p><?= htmlspecialchars($authenticatedUser->getEmail(), ENT_QUOTES, 'UTF-8') ?></p>
        </div>
    </section>

    <section class="profile--content">
        <div class="profile--info">
            <div class="profile--info__row">
                <label for="firstname">Prénom</label>
                <div class="profile--info__field"><?= htmlspecialchars($authenticatedUser->getFirstname(), ENT_QUOTES, 'UTF-8') ?></div>
            </div>
            <div class="profile--info__row">
                <label for="lastname">Nom</label>
                <div class="profile--info__field"><?= htmlspecialchars($authenticatedUser->getLastname(), ENT_QUOTES, 'UTF-8') ?></div>
            </div>
            <div class="profile--info__row">
                <label for="email">Email</label>
                <div class="profile--info__field"><?= htmlspecialchars($authenticatedUser->getEmail(), ENT_QUOTES, 'UTF-8') ?></div>
            </div>
            <div class="profile--info__row">
                <label for="status">Status</label>
                <div class="profile--info__field"><?= htmlspecialchars($authenticatedUser->getStringifiedStatus(), ENT_QUOTES, 'UTF-8') ?></div>
            </div>
        </div>

        <div>
            <a href="/profile/edit?id=<?= $authenticatedUser->getId(); ?>" class="profile--edit-btn">Changer mes informations</a>
        </div>
    </section>

    <section class="profile--statistics" >
        <h2>Quelques statistiques</h2>
        <div class="profile--stats">
            <div class="profile--stats__row">
                <?php
                $numberOfComments = 0;
                foreach ($userComments as $comment) {
                    if ($comment['status'] === 1) {
                        $numberOfComments++;
                    }
                }
                ?>
                <label for="status">Nombre de commentaires</label>
                <div class="profile--stats__field"><?= $numberOfComments ?></div>
            </div>
            <div class="profile--stats__row">
                <label for="status">Avec nous depuis</label>
                <div class="profile--stats__field">
                    <?php
                    $creationDate = new DateTime($authenticatedUser->getCreationDate());
                    $currentDate = new DateTime();
                    $interval = $currentDate->diff($creationDate);

                    switch (true) {
                        case ($interval->y > 0):
                            echo $interval->y . ' ' . ($interval->y > 1 ? 'ans' : 'an');
                            break;
                        case ($interval->m > 0):
                            echo $interval->m . ' mois'; // Pas de différence entre singulier et pluriel
                            break;
                        case ($interval->d >= 7):
                            $weeks = floor($interval->d / 7);
                            echo $weeks . ' ' . ($weeks > 1 ? 'semaines' : 'semaine');
                            break;
                        case ($interval->d > 0):
                            echo $interval->d . ' ' . ($interval->d > 1 ? 'jours' : 'jour');
                            break;
                        case ($interval->h > 0):
                            echo $interval->h . ' ' . ($interval->h > 1 ? 'heures' : 'heure');
                            break;
                        default:
                            echo 'Moins d\'une heure';
                            break;
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</main>
