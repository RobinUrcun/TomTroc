<?php

class InputErrorManager
{
    public bool $isMailError = false;
    public ?string $mailErrorMessage = "";
    public bool $isMailAlreadyUsed = false;

    public bool $isPseudoError = false;
    public bool $isPseudoAlreadyUsed = false;
    public ?string $pseudoErrorMessage = "";

    public bool $isPasswordError = false;
    public ?string $passwordErrorMessage = "";

    public bool $isInvalidCredentials = false;

    public bool $isFileError = false;
    public string $fileErrorMessage = "";

    public function setMailError(string $message)
    {
        $this->isMailError = true;
        $this->mailErrorMessage = $message;
    }

    public function setPseudoError(string $message)
    {
        $this->isPseudoError = true;
        $this->pseudoErrorMessage = $message;
    }

    public function setPasswordError(string $message)
    {
        $this->isPasswordError = true;
        $this->passwordErrorMessage = $message;
    }

    public function setFileError(string $message)
    {
        $this->isFileError = true;
        $this->fileErrorMessage = $message;
    }
}
