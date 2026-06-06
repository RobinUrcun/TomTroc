<?php

include_once(__DIR__ . "/../Layout/header.php");

?>

<section class="my_account_section">
    <h1 class="my_account_section_title">Mon compte</h1>
    <div class="my_account_section_wrapper">
        <div class="my_account_section_resume">

            <form class="update_avatar_form" method="POST" enctype="multipart/form-data" action="./index.php?page=mon_compte&action=editUserAvatar" name="avatar" id="upload_avatar_form">
                >
                <div class="my_account_section_avatar_wrapper">
                    <img src="./Public/Assets/to_delete/plat-1.jpeg" alt="">
                    <input type="file"
                        name="avatar"
                        class="upload_avatar_input"
                        id="upload_avatar_input">
                </div>

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
            <form class="update_user_info" action="/TomTroc/index.php?page=mon_compte&action=editUserInformations" method="POST">
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
        <div class="array_row">
            <div class="array_row_box">
                <img class="image" src="./Public/Assets/to_delete/3464b64a922f7d911d69633167d3700d8c0b3049.jpg" alt="">
            </div>
            <div class="array_row_box">
                <p class="title">The Kinkfolk Table</p>
            </div>
            <div class="array_row_box">
                <p class="author">Nathan Williams</p>
            </div>
            <div class="array_row_box">
                <p>J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table. </p>
            </div>
            <div class="array_row_box">
                <div class="chips">disponible</div>
            </div>
            <div class="array_row_box">
                <div class="array_row_box_action">
                    <form class="edit" action="">
                        <button>Éditer</button>
                    </form>
                    <form class="delete" action="">
                        <button>Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="array_row">
            <div class="array_row_box">
                <img class="image" src="./Public/Assets/to_delete/3464b64a922f7d911d69633167d3700d8c0b3049.jpg" alt="">
            </div>
            <div class="array_row_box">
                <p class="title">The Kinkfolk Table</p>
            </div>
            <div class="array_row_box">
                <p class="author">Nathan Williams</p>
            </div>
            <div class="array_row_box">
                <p>J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table. </p>
            </div>
            <div class="array_row_box">
                <div class="chips">disponible</div>
            </div>
            <div class="array_row_box">
                <div class="array_row_box_action">
                    <form class="edit" action="">
                        <button>Éditer</button>
                    </form>
                    <form class="delete" action="">
                        <button>Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="array_row">
            <div class="array_row_box">
                <img class="image" src="./Public/Assets/to_delete/3464b64a922f7d911d69633167d3700d8c0b3049.jpg" alt="">
            </div>
            <div class="array_row_box">
                <p class="title">The Kinkfolk Table</p>
            </div>
            <div class="array_row_box">
                <p class="author">Nathan Williams</p>
            </div>
            <div class="array_row_box">
                <p>J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table. </p>
            </div>
            <div class="array_row_box">
                <div class="chips">disponible</div>
            </div>
            <div class="array_row_box">
                <div class="array_row_box_action">
                    <form class="edit" action="">
                        <button>Éditer</button>
                    </form>
                    <form class="delete" action="">
                        <button>Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="array_row">
            <div class="array_row_box">
                <img class="image" src="./Public/Assets/to_delete/3464b64a922f7d911d69633167d3700d8c0b3049.jpg" alt="">
            </div>
            <div class="array_row_box">
                <p class="title">The Kinkfolk Table</p>
            </div>
            <div class="array_row_box">
                <p class="author">Nathan Williams</p>
            </div>
            <div class="array_row_box">
                <p>J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table. </p>
            </div>
            <div class="array_row_box">
                <div class="chips">disponible</div>
            </div>
            <div class="array_row_box">
                <div class="array_row_box_action">
                    <form class="edit" action="">
                        <button>Éditer</button>
                    </form>
                    <form class="delete" action="">
                        <button>Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="array_row">
            <div class="array_row_box">
                <img class="image" src="./Public/Assets/to_delete/3464b64a922f7d911d69633167d3700d8c0b3049.jpg" alt="">
            </div>
            <div class="array_row_box">
                <p class="title">The Kinkfolk Table</p>
            </div>
            <div class="array_row_box">
                <p class="author">Nathan Williams</p>
            </div>
            <div class="array_row_box">
                <p>J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table. </p>
            </div>
            <div class="array_row_box">
                <div class="chips">disponible</div>
            </div>
            <div class="array_row_box">
                <div class="array_row_box_action">
                    <form class="edit" action="">
                        <button>Éditer</button>
                    </form>
                    <form class="delete" action="">
                        <button>Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>

<script src="./Js/index.js"></script>


<?php

include_once(__DIR__ . "/../Layout/footer.php");

?>