<?php

include_once(__DIR__ . "/../Layout/header.php");

?>

<section class="my_account_section">
    <h1 class="my_account_section_title">Mon compte</h1>
    <div class="my_account_section_wrapper">
        <div class="my_account_section_resume">
            <div class="my_account_section_avatar_wrapper">
                <img src="./Public/Assets/to_delete/plat-1.jpeg" alt="">
            </div>
            <form class="update_avatar" action="">
                <button>modifier</button>
            </form>
            <div class="separator"></div>
            <div class="my_account_section_user_info_wrapper">
                <p class="pseudo"><?= isset($user) ? $user->getPseudo() : "" ?></p>
                <p class="user_registered_since">
                    Membre depuis 1 an
                </p>
                <p class="library">bibliotheque</p>

                <div class="books_count_wrapper">
                    <img src="./Public/Assets/Icons/books_icon.svg" alt="">
                    <p class="books_count">4 livres</p>
                </div>

            </div>
        </div>
        <div class="my_account_section_form">
            <form class="update_user_info" action="" method="POST">
                <h2 class="my_account_section_subtitle">Vos informations personnelles</h2>
                <div class="auth_input_wrapper">
                    <label for="mail">Adresse email</label>
                    <input value="<?= isset($user) ? $user->getMail() : null ?>" id="mail" name="mail" type="mail" class="<?= isset($inputErrorManager) && $inputErrorManager->isMailError ? 'error' : ''  ?>" />
                    <div class="auth_input_error_message <?= isset($inputErrorManager) && $inputErrorManager->isMailError ? 'active' : ''  ?>">
                        <?= isset($inputErrorManager) ? $inputErrorManager->mailErrorMessage : null  ?>
                    </div>
                    <div class="auth_input_error_message">
                        <?= isset($inputErrorManager) && $inputErrorManager->isMailAlreadyUsed ? "Adresse email déjà utilisée" : null  ?>
                    </div>
                </div>
                <div class="auth_input_wrapper">
                    <label for="password">Mot de passe</label>
                    <input id="password" name="password"
                        value="" type="password" class="<?= isset($inputErrorManager) && $inputErrorManager->isPasswordError ? 'error' : '' ?>" />
                    <div class="auth_input_error_message <?= isset($inputErrorManager) && $inputErrorManager->isPasswordError ? 'active' : '' ?>">
                        <?= isset($inputErrorManager) ? $inputErrorManager->passwordErrorMessage : null  ?>
                    </div>
                </div>
                <div class="auth_input_wrapper">
                    <label for="pseudo">Pseudo</label>
                    <input id="pseudo" name="pseudo" class="<?= isset($inputErrorManager) && $inputErrorManager->isPseudoError ? 'error' : ''  ?>" value="<?= isset($user) ? $user->getPseudo() : null ?>" />
                    <div class="auth_input_error_message <?= isset($inputErrorManager) && $inputErrorManager->isPseudoError ? 'active' : ''  ?>">
                        <?= isset($inputErrorManager) ? $inputErrorManager->pseudoErrorMessage : null  ?>
                    </div>
                </div>
                <button class="main_button">Enregistrer</button>
            </form>
        </div>
    </div>
</section>