<?php

class BookErrorManager
{
    public bool $isTitleError = false;
    public ?string $titleErrorMessage = "";

    public bool $isAuthorError = false;
    public ?string $authorErrorMessage = "";

    public bool $isCommentError = false;
    public ?string $commentErrorMessage = "";

    public bool $isDisponibilityError = false;
    public string $disponibilityErrorMessage = "";

    public bool $isFileError = false;
    public string $fileErrorMessage = "";

    public function setTitleError(string $message)
    {
        $this->isTitleError = true;
        $this->titleErrorMessage = $message;
    }

    public function setAuthorError(string $message)
    {
        $this->isAuthorError = true;
        $this->authorErrorMessage = $message;
    }

    public function setCommentError(string $message)
    {
        $this->isCommentError = true;
        $this->commentErrorMessage = $message;
    }

    public function setDisponibilityError(string $message)
    {
        $this->isDisponibilityError = true;
        $this->disponibilityErrorMessage = $message;
    }

    public function setFileError(string $message)
    {
        $this->isFileError = true;
        $this->fileErrorMessage = $message;
    }
}
