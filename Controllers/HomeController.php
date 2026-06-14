<?php


class HomeController
{
    public function getHomePage()
    {
        $title = "Acceuil";

        $bookRepository = new BookRepository();

        $lastBooks = $bookRepository->get(4);

        $user = AuthServices::getAuthenticatedUser();

        require_once('./Views/home.php');
    }
}
