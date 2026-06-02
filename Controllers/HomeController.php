<?php


class HomeController
{

    public function handle()
    {
        $title = "Acceuil";

        $user = AuthServices::getAuthenticatedUser();

        require_once('./Views/home.php');
    }
}
