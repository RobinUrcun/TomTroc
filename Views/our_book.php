<?php

include_once(__DIR__ . "/../Layout/header.php");
?>

<section class="our_books_section">
    <div class="hero">
        <h1>Nos livres à l'échange</h1>
        <form class="search_form" action="./index.php" method="GET">
            <input type="hidden" name="page" value="nos_livres">

            <button>
                <img src="./Public/Assets/Icons/magnifing_glass_icon.svg" alt="">
            </button>
            <label for="search">
            </label>
            <input type="text" placeholder="Rechercher un livre" name="search" id="search">
        </form>

    </div>

    <div class="display_all_books">
        <?php if (isset($books) && count($books)) : ?>

            <?php foreach ($books as $book) :  ?>
                <a href="index.php?page=livre&id=<?= $book->getId() ?>" class="card">
                    <img src="./Public/Uploads/Books/<?= $book->getImageFileName() ?>" alt="">
                    <div class="card_content">
                        <h2 class="card_title"><?= htmlspecialchars($book->getTitle()) ?></h2>
                        <p class="card_author"><?= htmlspecialchars($book->getAuthor()) ?></p>
                        <p class="card_sold_by">Vendu par : <?= htmlspecialchars($book->getUser()->getPseudo()) ?></p>
                    </div>
                </a>
            <?php endforeach;  ?>
        <?php else : ?>
            <div class="array_row no_books">
                Aucuns livres trouvés
            </div>
        <?php endif; ?>

    </div>
</section>

<?php

include_once(__DIR__ . "/../Layout/footer.php");

?>