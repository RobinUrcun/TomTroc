<?php

class BookController
{
    private ?User $user;

    public function __construct()
    {
        $this->user = AuthServices::getAuthenticatedUser();
    }

    public function getOurBookPage()
    {
        $user = $this->user;
        if (isset($_GET["search"]) && $_GET["search"]) {

            $bookRepository = new BookRepository();

            $books = $bookRepository->getByTitle($_GET["search"]);
        } else {
            $bookRepository = new BookRepository();

            $books = $bookRepository->get();
        }


        $title = "Nos livres à l'échange";
        require_once(__DIR__ . "/../Views/our_book.php");
    }

    public function getBookPage()
    {
        $user = $this->user;
        $id = isset($_GET["id"]) ? (int) $_GET["id"] : null;

        if (!$id) {
            Redirect::to("404");
            return;
        }
        try {

            $bookRepository = new BookRepository();

            $book = $bookRepository->getById($id);
        } catch (Exception $e) {
            Redirect::to("404");
            return;
        }

        if (!$book) {
            Redirect::to("404");
            return;
        }

        $title = $book->getTitle();
        require_once(__DIR__ . "/../Views/single_book.php");
    }
}
