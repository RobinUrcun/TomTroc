<?php

class BooksManagerController
{

    private User $user;

    public function __construct()
    {
        $user = AuthServices::getAuthenticatedUser();

        if (!$user) {

            Redirect::to("accueil");
            return;
        }

        $this->user = $user;
    }

    public function getCreateBookPage()
    {
        $user = $this->user;
        $tittle = "Ajouter un livre";

        require_once(__DIR__ . "/../Views/create_book.php");
    }
}
