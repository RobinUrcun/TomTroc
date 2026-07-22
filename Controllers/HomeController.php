<?php


class HomeController
{
    public function getHomePage()
    {
        $title = "Acceuil";

        $bookRepository = new BookRepository();

        try {
            $lastBooks = $bookRepository->get(4);
        } catch (Exception $e) {

            Redirect::to("404");
        }
        $user = AuthServices::getAuthenticatedUser();

        require_once(__DIR__ . '/../Views/home.php');
    }
}
