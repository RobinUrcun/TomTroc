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
        $title = "Ajouter un livre";

        require_once(__DIR__ . "/../Views/create_book.php");
    }

    public function create()
    {
        $title = isset($_POST["title"]) ? $_POST["title"] : null;
        $author = isset($_POST["author"]) ? $_POST["author"] : null;
        $comment = isset($_POST["comment"]) ? $_POST["comment"] : null;
        $disponibility = isset($_POST["disponibility"]) ? $_POST["disponibility"] : null;

        $bookErrorManager = new BookErrorManager();

        try {
            FormValidation::isTitleValid($title);
        } catch (Exception $e) {
            $bookErrorManager->setTitleError($e->getMessage());
        }

        try {
            FormValidation::isAuthorValid($author);
        } catch (Exception $e) {
            $bookErrorManager->setAuthorError($e->getMessage());
        }

        try {
            FormValidation::isCommentValid($comment);
        } catch (Exception $e) {
            $bookErrorManager->setCommentError($e->getMessage());
        }

        try {
            FormValidation::isDisponibilityValid($disponibility);
        } catch (Exception $e) {
            $bookErrorManager->setDisponibilityError($e->getMessage());
        }

        if ($bookErrorManager->isTitleError || $bookErrorManager->isAuthorError || $bookErrorManager->isCommentError || $bookErrorManager->isDisponibilityError) {
            $title = "Ajouter un livre";
            $previousTitle = $title;
            $previousAuthor = $author;
            $previousComment = $comment;
            $previousDisponibility = $disponibility;

            require_once(__DIR__ . "../../Views/create_book.php");
            return;
        }
    }
}
