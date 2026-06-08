<?php

include_once(__DIR__ . "/../Layout/header.php");

?>

<section class="update_book_section">
    <div class="back_button_wrapper">
        <img class="back_button_icon" src="Public/Assets/Icons/arrow_left.svg" alt="">
        <a class="back_button" href="index.php?page=mon_compte">
            retour</a>
    </div>

    <h1>Modifier les informations</h1>

    <div class="form_wrapper">
        <form action="">
            <div class="image_upload_wrapper">
                <label for="book_image">
                    Photo
                </label>
                <div class="image_wrapper">
                    <img src="Public/Assets/Auth/auth_banner.jpg" alt="">
                </div>
            </div>
            <div class="informations_upload_wrapper">

                <div class="auth_input_wrapper">
                    <label for="title">Titre</label>
                    <input value="<?= isset($user) ? $user->getMail() : null ?>" id="title" name="title" type="text" class="<?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'error' : ''  ?>" />
                    <div class="auth_input_error_message <?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'active' : ''  ?>">
                        <?= isset($accountErrorManager) ? $accountErrorManager->mailErrorMessage : null  ?>
                    </div>
                    <div class="auth_input_error_message">
                        <?= isset($accountErrorManager) && $accountErrorManager->isMailAlreadyUsed ? "Adresse email déjà utilisée" : null  ?>
                    </div>
                </div>

                <div class="auth_input_wrapper">
                    <label for="author">Auteur</label>
                    <input value="<?= isset($user) ? $user->getMail() : null ?>" id="author" name="author" type="text" class="<?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'error' : ''  ?>" />
                    <div class="auth_input_error_message <?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'active' : ''  ?>">
                        <?= isset($accountErrorManager) ? $accountErrorManager->mailErrorMessage : null  ?>
                    </div>
                    <div class="auth_input_error_message">
                        <?= isset($accountErrorManager) && $accountErrorManager->isMailAlreadyUsed ? "Adresse email déjà utilisée" : null  ?>
                    </div>
                </div>

                <div class="auth_input_wrapper">
                    <label for="comment">Commentaire</label>
                    <textarea value="<?= isset($user) ? $user->getMail() : null ?>" id="comment" name="comment" class="<?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'error' : ''  ?>"></textarea>
                    <div class="auth_input_error_message <?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'active' : ''  ?>">
                        <?= isset($accountErrorManager) ? $accountErrorManager->mailErrorMessage : null  ?>
                    </div>
                    <div class="auth_input_error_message">
                        <?= isset($accountErrorManager) && $accountErrorManager->isMailAlreadyUsed ? "Adresse email déjà utilisée" : null  ?>
                    </div>
                </div>

                <div class="auth_input_wrapper">
                    <label for="title">disponibilité</label>
                    <select name="disponibility" id="disponibility">
                        <option value="available">Disponible</option>
                        <option value="unavailable">Non disponible</option>
                    </select>
                    <div class="auth_input_error_message <?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'active' : ''  ?>">
                        <?= isset($accountErrorManager) ? $accountErrorManager->mailErrorMessage : null  ?>
                    </div>
                    <div class="auth_input_error_message">
                        <?= isset($accountErrorManager) && $accountErrorManager->isMailAlreadyUsed ? "Adresse email déjà utilisée" : null  ?>
                    </div>
                </div>

                <button class="main_button">Valider</button>
        </form>

    </div>
</section>

<?php

include_once(__DIR__ . "/../Layout/footer.php");

?>