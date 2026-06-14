<?php

class OurBookController
{

    public function getOurBookPage()
    {
        $user = AuthServices::getAuthenticatedUser();

        if (isset($_GET["search"]) && $_GET["search"]) {

            $bookRepository = new BookRepository();

            $books = $bookRepository->getByTitle($_GET["search"]);
        } else {
            $bookRepository = new BookRepository();

            $books = $bookRepository->get();
        }


        $title = "Nos livres à l'échange";
        require_once("./Views/our_book.php");
    }
}
