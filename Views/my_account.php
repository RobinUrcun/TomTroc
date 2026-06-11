<?php

include_once(__DIR__ . "/../Layout/header.php");

?>

<section class="my_account_section">
    <h1 class="my_account_section_title">Mon compte</h1>
    <div class="my_account_section_wrapper">
        <div class="my_account_section_resume">

            <img class="avatar_img" src="./Public/Uploads/Avatars/<?= isset($user) ? $user->getAvatarFileName() : null ?>" alt="">

            <form class="update_avatar_form" method="POST" enctype="multipart/form-data" action="./index.php?page=mon_compte&action=editUserAvatar" id="upload_avatar_form">
                <label for="upload_avatar_input">modifier</label>
                <input type="file"
                    name="avatar"
                    class="upload_avatar_input"
                    id="upload_avatar_input">
            </form>
            <div class="auth_input_error_message <?= isset($accountErrorManager) && $accountErrorManager->isFileError ? 'active' : ''  ?>">
                <?= isset($accountErrorManager) ? $accountErrorManager->fileErrorMessage : null  ?>
            </div>

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
            <form class="update_user_info" action="/TomTroc/index.php?page=mon_compte&action=editUserInformations" method="POST">
                <h2 class="my_account_section_subtitle">Vos informations personnelles</h2>
                <div class="auth_input_wrapper">
                    <label for="mail">Adresse email</label>
                    <input value="<?= isset($user) ? $user->getMail() : null ?>" id="mail" name="mail" type="email" class="<?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'error' : ''  ?>" />
                    <div class="auth_input_error_message <?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'active' : ''  ?>">
                        <?= isset($accountErrorManager) ? $accountErrorManager->mailErrorMessage : null  ?>
                    </div>
                    <div class="auth_input_error_message">
                        <?= isset($accountErrorManager) && $accountErrorManager->isMailAlreadyUsed ? "Adresse email déjà utilisée" : null  ?>
                    </div>
                </div>
                <div class="auth_input_wrapper">
                    <label for="password">Mot de passe</label>
                    <input id="password" name="password"
                        value="" type="password" class="<?= isset($accountErrorManager) && $accountErrorManager->isPasswordError ? 'error' : '' ?>" />
                    <div class="auth_input_error_message <?= isset($accountErrorManager) && $accountErrorManager->isPasswordError ? 'active' : '' ?>">
                        <?= isset($accountErrorManager) ? $accountErrorManager->passwordErrorMessage : null  ?>
                    </div>
                </div>
                <div class="auth_input_wrapper">
                    <label for="pseudo">Pseudo</label>
                    <input id="pseudo" name="pseudo" class="<?= isset($accountErrorManager) && $accountErrorManager->isPseudoError ? 'error' : ''  ?>" value="<?= isset($user) ? $user->getPseudo() : null ?>" />
                    <div class="auth_input_error_message <?= isset($accountErrorManager) && $accountErrorManager->isPseudoError ? 'active' : ''  ?>">
                        <?= isset($accountErrorManager) ? $accountErrorManager->pseudoErrorMessage : null  ?>
                    </div>
                </div>
                <button class="main_button">Enregistrer</button>
            </form>
        </div>
    </div>
</section>

<section class="my_book_section">
    <div class="my_book_section_wrapper">
        <div class="array_header">
            <div class="array_header_box">
                <p>PHOTO</p>
            </div>
            <div class="array_header_box">
                <p>TITRE</p>
            </div>
            <div class="array_header_box">
                <p>AUTHEUR</p>
            </div>
            <div class="array_header_box">
                <p>DESCRIPTION</p>
            </div>
            <div class="array_header_box">
                <p>DISPONIBILITÉ</p>
            </div>
            <div class="array_header_box">
                <p>ACTION</p>
            </div>
        </div>
        <?php if (isset($user)): ?>
            <?php foreach ($user->getBooks() as $index => $book) : ?>
                <div class="array_row <?= ($index % 2) ? 'colored_background' : '' ?>">
                    <div class="array_row_box">
                        <img class="image" src="./Public/Uploads/Books/<?= $book->getImageFileName() ?>" alt="">
                    </div>
                    <div class="array_row_box">
                        <p class="title"><?= $book->getTitle() ?></p>
                    </div>
                    <div class="array_row_box">
                        <p class="author"><?= $book->getAuthor() ?></p>
                    </div>
                    <div class="array_row_box">
                        <p><?= $book->getComment() ?></p>
                    </div>
                    <div class="array_row_box">
                        <div class="chips"><?= $book->getDisponibility() === "available" ? "disponible" : "non dispo." ?></div>
                    </div>
                    <div class="array_row_box">
                        <div class="array_row_box_action">
                            <a class="edit" href="index.php?page=modifier_un_livre&book_id=<?= $book->getId() ?>">
                                Éditer
                            </a>
                            <a class="delete" href="index.php?page=modifier_un_livre&book_id=<?= $book->getId() ?>">
                                Supprimer
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <a href="index.php?page=ajouter_un_livre" class="main_button">
        Ajouter un livre
    </a>
</section>

<script src="./Js/index.js"></script>


<?php

include_once(__DIR__ . "/../Layout/footer.php");

?>