<section class="edit-profile">
    <div class="edit-profile__container">
        <h2 class="edit-profile__title">Modifier mes informations</h2>

        <!-- Profile Update Form -->
        <div class="edit-profile__form">
            <?= $updateProfileForm ?>
        </div>

        <!-- Danger Zone for sensitive actions -->
        <section class="edit-profile__danger-zone">
            <h3 class="edit-profile__danger-title">Zone de danger</h3>

            <!-- Reset Password Action -->
            <div class="edit-profile__danger-item">
                <h4 class="edit-profile__danger-heading">Réinitialisation de mot de passe</h4>
                <p class="edit-profile__danger-description">Recevoir un lien pour changer votre mot de passe. Le lien expire après 12 heures.</p>
                <a href="/sendResetPassword?id=<?= $authenticatedUser->getId(); ?>" class="edit-profile__danger-button">Oui, envoyez moi un lien</a>
            </div>

            <!-- Delete Account Action -->
            <div class="edit-profile__danger-item">
                <h4 class="edit-profile__danger-heading">Supprimer mon compte</h4>
                <p class="edit-profile__danger-description">Cette action est irreversible, pour toujours !</p>
                <a href="/profile/predelete?id=<?= $authenticatedUser->getId(); ?>" class="edit-profile__danger-button">Oui, supprimez mon compte</a>
            </div>
        </section>
    </div>
</section>
