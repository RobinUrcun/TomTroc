<?php


class HomeController
{
    public function getHomePage()
    {
        $title = "Acceuil";

        $user = AuthServices::getAuthenticatedUser();

        require_once('./Views/home.php');
    }
}
