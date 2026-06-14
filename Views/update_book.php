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
        <form enctype="multipart/form-data" action="./index.php?page=modifier_un_livre&book_id=<?= isset($book) ? $book->getId() : "" ?>" method="POST">
            <div class="image_upload_wrapper">
                <h2 for="book_picture">
                    Photo
                </h2>
                <div class="image_wrapper">
                    <img src="Public/Uploads/Books/<?= isset($book) ? $book->getImageFileName() : 'default_book_image.webp' ?>" alt="">
                </div>

                <label class="file_uploader_label" for="book_picture">
                    Modifier la photo
                </label>

                <input class="file_uploader_input<?= isset($bookErrorManager) && $bookErrorManager->isFileError ? 'error' : ''  ?>" id="book_picture" name="book_picture" type="file" accept="image/jpeg,image/png,image/webp">

                <div class="auth_input_error_message <?= isset($bookErrorManager) && $bookErrorManager->isFileError ? 'active' : ''  ?>">
                    <?= isset($bookErrorManager) ? $bookErrorManager->fileErrorMessage : null  ?>
                </div>
            </div>
            <div class="informations_upload_wrapper">

                <div class="auth_input_wrapper">
                    <label for="title">Titre</label>
                    <input value="<?= isset($previousTitle) ? $previousTitle : (isset($book) ? $book->getTitle() : null) ?>" id="title" name="title" type="text" class="<?= isset($bookErrorManager) && $bookErrorManager->isTitleError ? 'error' : ''  ?>" />
                    <div class="auth_input_error_message <?= isset($bookErrorManager) && $bookErrorManager->isTitleError ? 'active' : ''  ?>">
                        <?= isset($bookErrorManager) ? $bookErrorManager->titleErrorMessage : null  ?>
                    </div>
                </div>

                <div class="auth_input_wrapper">
                    <label for="author">Auteur</label>
                    <input value="<?= isset($previousAuthor) ? $previousAuthor : (isset($book) ? $book->getAuthor() : null) ?>" id="author" name="author" type="text" class="<?= isset($bookErrorManager) && $bookErrorManager->isAuthorError ? 'error' : ''  ?>" />
                    <div class="auth_input_error_message <?= isset($bookErrorManager) && $bookErrorManager->isAuthorError ? 'active' : ''  ?>">
                        <?= isset($bookErrorManager) ? $bookErrorManager->authorErrorMessage : null  ?>
                    </div>
                </div>

                <div class="auth_input_wrapper">
                    <label for="comment">Commentaire</label>
                    <textarea id="comment" name="comment" class="<?= isset($bookErrorManager) && $bookErrorManager->isCommentError ? 'error' : ''  ?>"><?= isset($previousComment) ? $previousComment : (isset($book) ? $book->getComment() : "") ?></textarea>
                    <div class="auth_input_error_message <?= isset($bookErrorManager) && $bookErrorManager->isCommentError ? 'active' : ''  ?>">
                        <?= isset($bookErrorManager) ? $bookErrorManager->commentErrorMessage : null  ?>
                    </div>
                </div>

                <div class="auth_input_wrapper">
                    <label for="title">disponibilité</label>
                    <select class="<?= isset($bookErrorManager) && $bookErrorManager->isDisponibilityError ? 'error' : ''  ?>" name="disponibility" id="disponibility">
                        <option <?= isset($previousDisponibility) && $previousDisponibility === "available" ? "selected" : (isset($book) && $book->getDisponibility() === "available" ? "selected" : "") ?> value="available">Disponible</option>
                        <option <?= isset($previousDisponibility) && $previousDisponibility === "unavailable" ? "selected" : (isset($book) && $book->getDisponibility() === "unavailable" ? "selected" : "") ?> value="unavailable">Non disponible</option>
                    </select>
                    <div class="auth_input_error_message <?= isset($bookErrorManager) && $bookErrorManager->isDisponibilityError ? 'active' : ''  ?>">
                        <?= isset($bookErrorManager) ? $bookErrorManager->disponibilityErrorMessage : null  ?>
                    </div>
                </div>

                <button class="main_button">Valider</button>
        </form>

    </div>
</section>

<?php

include_once(__DIR__ . "/../Layout/footer.php");

?>