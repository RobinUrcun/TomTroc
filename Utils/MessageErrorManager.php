<?php

class MessageErrorManager
{
    public bool $isContentError = false;
    public ?string $contentErrorMessage = "";

    public function setContentError(string $message)
    {
        $this->isContentError = true;
        $this->contentErrorMessage = $message;
    }
}
