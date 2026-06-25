<?php

include_once(__DIR__ . "/../Layout/header.php");

?>

<section class="homepage_section">
    <div>
        <h1 class="homepage_title">Rejoignez nos lecteurs passionnés</h1>
        <p class="homepage_description">
            Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres.
        </p>
        <a href="index.php?page=nos_livres" class="main_button">
            Découvrir
        </a>
    </div>
    <figure class="homepage_figure">
        <img class="homepage_img" src="./Public/Assets/Home/home_page_img.jpg" alt="">
        <figcaption class="homepage_figcaption">Hamza</figcaption>
    </figure>

</section>

<section class="our_last_books_add_section">
    <h2 class="our_last_books_add_title">
        Les derniers livres ajoutés
    </h2>

    <div class="our_last_books_add_section_wrapper">
        <?php if (isset($lastBooks) && count($lastBooks)) : ?>

            <?php foreach ($lastBooks as $book) :  ?>
                <a href="./index.php?page=livre&id=<?= $book->getId() ?>" class="card">
                    <img src="./Public/Uploads/Books/<?= $book->getImageFileName() ?>" alt="">
                    <div class="card_content">
                        <h2 class="card_title"><?= $book->getTitle() ?></h2>
                        <p class="card_author"><?= $book->getAuthor() ?></p>
                        <p class="card_sold_by"><?= $book->getUser()->getPseudo() ?></p>
                    </div>
                </a>
            <?php endforeach;  ?>

        <?php endif; ?>
    </div>
    <a href="index.php?page=nos_livres" class="main_button">
        Voir tous les livres
    </a>
</section>

<section class="how_it_work_section">
    <h2 class="how_it_work_title">
        Comment ça marche ?
    </h2>
    <p class="how_it_work_description">
        Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :
    </p>
    <div class="how_it_work_wrapper">
        <div class="how_it_work_card">
            <p>Inscrivez-vous gratuitement sur notre plateforme.</p>
        </div>
        <div class="how_it_work_card">
            <p>Ajoutez les livres que vous souhaitez échanger à votre profil.</p>
        </div>
        <div class="how_it_work_card">
            <p>Parcourez les livres disponibles chez d'autres membres.</p>
        </div>
        <div class="how_it_work_card">
            <p>Proposez un échange et discutez avec d'autres passionnés de lecture.</p>
        </div>
    </div>
    <a href="index.php?page=nos_livres" class="main_button reverse_button">
        Voir tous les livres
    </a>
</section>
<div class="homepage_banner">
</div>
<section class="our_values_section">
    <div class="our_values_wrapper">
        <h2 class="our_values_title">Nos valeurs</h2>
        <p>
            Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.
        </p>
        <p>
            Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé.
        <p>
            Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.
        </p>
        </p>
        <div class="signature_wrapper">
            <p class="signature">L’équipe Tom Troc</p> <img src="./Public/Assets/Icons/heart.svg" alt="">
        </div>
    </div>
</section>


<?php

include_once(__DIR__ . "/../Layout/footer.php");

?>