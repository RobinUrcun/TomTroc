<?php

include_once(__DIR__ . "/../Layout/header.php");
?>

<section class="book_section">
    <div class="book_section_image_wrapper" style="background-image: url(<?= isset($book) ? "./Public/Uploads/Books/" . $book->getImageFileName() . ')' : ')'  ?>">

    </div>
    <div class="book_section_content_wrapper">
        <h1><?= isset($book) ? $book->getTitle() : "" ?></h1>
        <p class="book_section_author">par <?= isset($book) ? $book->getAuthor() : "" ?></p>
        <div class="book_section_separator"></div>
        <h2>DESCRIPTION</h2>
        <p class="book_section_description">
            <?= isset($book) ? $book->getComment() : "" ?>
        </p>
        <h2>PROPRIÉTAIRE</h2>

        <a href="./index.php?page=compte_utilisateur&user_id=<?= isset($book) ? $book->getUser()->getId() : "" ?>" class="book_section_user_informations">
            <div class="book_section_user_avatar">
                <img src="./Public/Uploads/Avatars/<?= isset($book) ? $book->getUser()->getAvatarFileName() : "" ?>" alt="">
            </div>
            <div class="book_section_user_pseudo"><?= isset($book) ? $book->getUser()->getPseudo() : "" ?></div>
        </a>

        <a class="book_section_button main_button" href="./index.php?page=compte_utilisateur&user_id=<?= isset($book) ? $book->getUser()->getId() : "" ?>">Envoyer un message</a>

    </div>
</section>


<?php

include_once(__DIR__ . "/../Layout/footer.php");

?>