<?php

include_once(__DIR__ . "/../Layout/header.php");

?>
<section class="user_account_section">

    <div class="user_account_section_resume">

        <img class="avatar_img" src="./Public/Uploads/Avatars/<?= isset($user_account) ? $user_account->getAvatarFileName() : null ?>" alt="">

        <div class="separator"></div>
        <div class="user_account_section_user_info_wrapper">
            <p class="pseudo"><?= isset($user_account) ? htmlspecialchars($user_account->getPseudo()) : "" ?></p>
            <p class="user_registered_since">
                Membre depuis
                <?= isset($user_account) ? DateFormater::format($user_account->getCreatedAt()) : "" ?>
            </p>
            <p class="library">bibliotheque</p>

            <div class="books_count_wrapper">
                <img src="./Public/Assets/Icons/books_icon.svg" alt="">
                <p class="books_count"><?= isset($user_account) ? $user_account->getCreatedBooksCount() : "" ?> livre<?= isset($user_account) && $user_account->getCreatedBooksCount() > 1 ? "s" : "" ?></p>
            </div>

        </div>
        <a href="./index.php?page=messagerie&utilisateur_id=<?= isset($user_account) ? $user_account->getId() : "" ?>" class="main_button send_message_button">Écrire un message</a>
    </div>

    <div class="book_section_wrapper">
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

        </div>
        <?php if (isset($user_account) && count($user_account->getBooks())): ?>
            <?php foreach ($user_account->getBooks() as $index => $book) : ?>
                <a href="./index.php?page=livre&id=<?= isset($book) ? $book->getId() : '' ?>" class="array_row <?= ($index % 2) ? 'colored_background' : '' ?>">
                    <div class="array_row_box">
                        <img class="image" src="./Public/Uploads/Books/<?= $book->getImageFileName() ?>" alt="">
                    </div>
                    <div class="array_row_box">
                        <p class="title"><?= htmlspecialchars($book->getTitle()) ?></p>
                    </div>
                    <div class="array_row_box">
                        <p class="author"><?= htmlspecialchars($book->getAuthor()) ?></p>
                    </div>
                    <div class="array_row_box comment">
                        <p><?= htmlspecialchars($book->getComment()) ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else : ?>
            <div class="array_row no_books">
                Aucuns livres enregistrés
            </div>
        <?php endif; ?>
    </div>
</section>
<?php

include_once(__DIR__ . "/../Layout/footer.php");

?>