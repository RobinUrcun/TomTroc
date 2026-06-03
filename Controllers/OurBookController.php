<?php

class OurBookController
{

    public function getOurBookPage()
    {
        $user = AuthServices::getAuthenticatedUser();

        $title = "Nos livres à l'échange";
        require_once("./Views/our_book.php");
    }
}
