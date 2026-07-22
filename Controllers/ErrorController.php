<?php

class ErrorController
{

    private ?User $user;

    public function __construct()
    {
        $this->user = AuthServices::getAuthenticatedUser();

        if (!$this->user) {
            Redirect::to("connexion");
        }
    }

    public function getErrorPage()
    {

        $user = $this->user;

        require_once(__DIR__ . "/../Views/404.php");
    }
}
