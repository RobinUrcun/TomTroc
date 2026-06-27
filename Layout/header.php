<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles.css">
    <title><?= $title ?? "TomTroc"; ?></title>
</head>

<body>
    <header>
        <div class="header_first_part">
            <div class="logo_with_title">
                <img src="./Public/Assets/logo.png" alt="" width="53" height="53">
                <p>Tom Troc</p>
            </div>
            <nav class="header_nav">
                <a href="index.php">Accueil</a>
                <a href="index.php?page=nos_livres">Nos livres à l’échange</a>
            </nav>
        </div>
        <div class="header_second_part">
            <?php if (isset($user)): ?>
                <a href="index.php?page=messagerie">
                    <img class="icon" src="./Public/Assets/Icons/message_icon.svg" alt="">
                    <span>Messagerie</span>
                    <div class="counter_wrapper">
                        <p>1</p>
                    </div>
                </a>
                <a href="index.php?page=mon_compte">
                    <img class="icon" src="./Public/Assets/Icons/account_icon.svg" alt="">
                    <span>Mon compte</span>
                </a>
                <a href="index.php?page=deconnexion">
                    <img class="icon" src="./Public/Assets/Icons/logout_icon.svg" alt="">
                    <span>Deconnexion</span>
                </a>
            <?php else : ?>
                <a href="index.php?page=connexion">
                    <span>Connexion</span>
                </a>
                <a href="index.php?page=inscription">
                    <span>Inscription</span>
                </a>
            <?php endif; ?>
        </div>
    </header>