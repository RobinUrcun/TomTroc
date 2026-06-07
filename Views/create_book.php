<?php

include_once(__DIR__ . "/../Layout/header.php");

?>

<section class="create_book_section">
    <div class="back_button_wrapper">
        <img class="back_button_icon" src="Public/Assets/Icons/arrow_left.svg" alt="">
        <a class="back_button" href="index.php?page=mon_compte">
            retour</a>
    </div>

    <h1>Ajouter un livre</h1>

    <div class="form_wrapper">
        <form method="POST" enctype="multipart/form-data" action="./index.php?page=ajouter_un_livre">
            <div class="image_upload_wrapper">
                <label for="book_image">
                    Photo
                </label>
                <input type="file" name="book_picture" id="book_picture">
            </div>
            <div class="informations_upload_wrapper">

                <div class="auth_input_wrapper">
                    <label for="title">Titre</label>
                    <input placeholder="The Kinkfolk Table" id="title" name="title" type="text" class="<?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'error' : ''  ?>" />
                    <div class="auth_input_error_message <?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'active' : ''  ?>">
                        <?= isset($accountErrorManager) ? $accountErrorManager->mailErrorMessage : null  ?>
                    </div>
                </div>

                <div class="auth_input_wrapper">
                    <label for="author">Auteur</label>
                    <input placeholder="Nathan Williams" id="author" name="author" type="text" class="<?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'error' : ''  ?>" />
                    <div class="auth_input_error_message <?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'active' : ''  ?>">
                        <?= isset($accountErrorManager) ? $accountErrorManager->mailErrorMessage : null  ?>
                    </div>
                </div>

                <div class="auth_input_wrapper">
                    <label for="comment">Commentaire</label>
                    <textarea placeholder="J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table. \n Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. 

Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. 

'The Kinfolk Table' incarne parfaitement l'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes." id="comment" name="comment" class="<?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'error' : ''  ?>"></textarea>
                    <div class="auth_input_error_message <?= isset($accountErrorManager) && $accountErrorManager->isMailError ? 'active' : ''  ?>">
                        <?= isset($accountErrorManager) ? $accountErrorManager->mailErrorMessage : null  ?>
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
                </div>

                <button class="main_button">Valider</button>
        </form>

    </div>
</section>

<?php

include_once(__DIR__ . "/../Layout/footer.php");

?>