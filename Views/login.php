<?php

require_once(__DIR__ . "../../Layout/header.php");
?>

<section class="auth_section">
    <div class="auth_form_wrapper">
        <h1>Connexion</h1>
        <form class="auth_form" action="" method="POST">
            <div class="auth_input_wrapper">
                <label for="mail">Adresse email</label>
                <input value="<?= $previousMail ?? null ?>" id="mail" name="mail" type="mail" class="<?= isset($inputErrorManager) && $inputErrorManager->isMailError ? 'error' : ''  ?>" />
                <div class="auth_input_error_message">
                    <?= isset($inputErrorManager) ? $inputErrorManager->mailErrorMessage : null  ?>
                </div>
            </div>
            <div class="auth_input_wrapper">
                <label for="password">Mot de passe</label>
                <input id="password" name="password" type="password" class="<?= isset($inputErrorManager) && $inputErrorManager->isPasswordError ? 'error' : '' ?>" />
                <div class="auth_input_error_message">
                    <?= isset($inputErrorManager) ? $inputErrorManager->passwordErrorMessage : null  ?>
                </div>
            </div>

            <?php if (isset($inputErrorManager) && $inputErrorManager->isInvalidCredentials) : ?>
                <div class="auth_section_failed_login">
                    Email ou mot de passe incorrect
                </div>
            <?php endif; ?>

            <button class="main_button">Se connecter</button>
        </form>
        <p class="auth_no_account_link">Pas de compte ? <a href="index.php?page=inscription">Inscrivez-vous</a></p>
    </div>
    <div class="auth_banner_wrapper">
        <img class="auth_banner" src="Public/Assets/Auth/auth_banner.jpg" alt="">
    </div>
</section>

<?php

require_once(__DIR__ . "../../Layout/footer.php");

?>