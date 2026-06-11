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

    public function getUpdateBookPage()
    {
        $book_id = isset($_GET["book_id"]) ? (int)$_GET["book_id"] : null;

        if (!$book_id) {

            Redirect::to("404");
            return;
        }

        $bookRepository = new BookRepository();

        try {
            $book = $bookRepository->getById($book_id);
        } catch (Exception $e) {

            Redirect::to("404");
            return;
        }

        if (!$book) {
            Redirect::to("404");
            return;
        }

        $user = $this->user;

        if ($book->getUserId() !== $user->getId()) {

            Redirect::to("404");
            return;
        }

        $title = "Modifier un livre";

        require_once(__DIR__ . "/../Views/update_book.php");
    }

    public function create()
    {
        $user = $this->user;

        $bookTitle = isset($_POST["title"]) ? $_POST["title"] : null;
        $author = isset($_POST["author"]) ? $_POST["author"] : null;
        $comment = isset($_POST["comment"]) ? $_POST["comment"] : null;
        $disponibility = isset($_POST["disponibility"]) ? $_POST["disponibility"] : null;
        $file = isset($_FILES["book_picture"]) ? $_FILES["book_picture"] : null;


        $bookErrorManager = new BookErrorManager();

        try {
            FormValidation::isTitleValid($bookTitle);
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

        if ($file["tmp_name"]) {

            try {
                $fileManager = new FileManager($file);
            } catch (Error $e) {

                $bookErrorManager->setFileError($e->getMessage());
                return;
            }

            if (!FormValidation::isFileSizeCorrect($fileManager->size)) {
                $bookErrorManager->setFileError("La taille du fichier ne doit pas exceder 5 Mo");
            } else {
                $mappingFileMimeType = [
                    "image/jpeg" => "jpg",
                    "image/png"  => "png",
                    "image/webp" => "webp",
                ];

                if (!isset($mappingFileMimeType[$fileManager->mimeType])) {

                    $bookErrorManager->setFileError("le fichier doit etre du type png ou jpeg ou webp");
                }
            }
        }

        if ($bookErrorManager->isTitleError || $bookErrorManager->isAuthorError || $bookErrorManager->isCommentError || $bookErrorManager->isDisponibilityError || $bookErrorManager->isFileError) {
            $title = "Ajouter un livre";
            $previousTitle = $bookTitle;
            $previousAuthor = $author;
            $previousComment = $comment;
            $previousDisponibility = $disponibility;

            require_once(__DIR__ . "../../Views/create_book.php");
            return;
        }

        if ($file["tmp_name"]) {

            $fileName = uniqid() . "." . $mappingFileMimeType[$fileManager->mimeType];

            move_uploaded_file($file["tmp_name"], __DIR__ . "/../Public/Uploads/Books/" . $fileName);
        }


        $bookRepository = new BookRepository();

        $fileName = $fileName ?? 'default_book_image.webp';

        try {
            $bookRepository->create($bookTitle, $author, $comment, $disponibility, $this->user->getId(), $fileName);
        } catch (Error $e) {

            Redirect::to("404");
            return;
        }

        Redirect::to("mon_compte");
    }

    public function update()
    {
        $user = $this->user;

        $bookId = isset($_GET["book_id"]) ? (int) $_GET["book_id"] : null;

        if (!$bookId) {
            Redirect::to("404");
            return;
        }

        $bookRepository = new BookRepository();


        try {
            $book = $bookRepository->getById($bookId);
        } catch (Exception $e) {
            Redirect::to("404");
            return;
        }

        if ($book->getUserId() !== $user->getId()) {
            Redirect::to("404");
            return;
        }

        $bookTitle = isset($_POST["title"]) ? $_POST["title"] : null;
        $author = isset($_POST["author"]) ? $_POST["author"] : null;
        $comment = isset($_POST["comment"]) ? $_POST["comment"] : null;
        $disponibility = isset($_POST["disponibility"]) ? $_POST["disponibility"] : null;
        $file = isset($_FILES["book_picture"]) ? $_FILES["book_picture"] : null;


        $bookErrorManager = new BookErrorManager();

        try {
            FormValidation::isTitleValid($bookTitle);
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


        if ($file["tmp_name"]) {

            try {
                $fileManager = new FileManager($file);
            } catch (Error $e) {

                $bookErrorManager->setFileError($e->getMessage());
                return;
            }

            if (!FormValidation::isFileSizeCorrect($fileManager->size)) {
                $bookErrorManager->setFileError("La taille du fichier ne doit pas exceder 5 Mo");
            } else {
                $mappingFileMimeType = [
                    "image/jpeg" => "jpg",
                    "image/png"  => "png",
                    "image/webp" => "webp",
                ];

                if (!isset($mappingFileMimeType[$fileManager->mimeType])) {

                    $bookErrorManager->setFileError("le fichier doit etre du type png ou jpeg ou webp");
                }
            }
        }

        if ($bookErrorManager->isTitleError || $bookErrorManager->isAuthorError || $bookErrorManager->isCommentError || $bookErrorManager->isDisponibilityError || $bookErrorManager->isFileError) {
            $title = "Ajouter un livre";
            $previousTitle = $bookTitle;
            $previousAuthor = $author;
            $previousComment = $comment;
            $previousDisponibility = $disponibility;

            require_once(__DIR__ . "../../Views/update_book.php");
            return;
        }

        if ($file["tmp_name"]) {

            $fileName = uniqid() . "." . $mappingFileMimeType[$fileManager->mimeType];

            unlink(__DIR__ . "/../Public/Uploads/Avatars/" . $book->getImageFileName());

            move_uploaded_file($file["tmp_name"], __DIR__ . "/../Public/Uploads/Books/" . $fileName);
        }

        $fileName = $fileName ?? $book->getImageFileName();

        try {
            $bookRepository->update($bookTitle, $author, $comment, $disponibility, $fileName, $bookId);
        } catch (Error $e) {

            Redirect::to("404");
            return;
        }

        Redirect::to("mon_compte");
    }
}
