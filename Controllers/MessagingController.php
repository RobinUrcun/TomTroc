<?php

class MessagingController
{

    private ?User $user;

    public function __construct()
    {
        $this->user = AuthServices::getAuthenticatedUser();
    }

    public function getMessagingPage(): void
    {
        $user = $this->user;

        require_once("./Views/messaging.php");
    }
}
