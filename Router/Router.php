<?php


class Router
{
    private string $params;
    public string $method;

    public function __construct()
    {
        $this->params = $_GET["page"] ?? 'accueil';
        $this->method = $_SERVER["REQUEST_METHOD"];
    }

    public function routing()
    {
        switch ($this->params) {
            case "accueil":

                $controller = new HomeController();
                $controller->getHomePage();
                break;

            case "nos_livres":

                $controller = new OurBookController();
                $controller->getOurBookPage();
                break;

            case "connexion":


                $authController = new AuthController();

                if ($this->method === "GET") {
                    $authController->getLoginPage();
                } elseif ($this->method === "POST") {
                    $authController->login();
                }
                break;


            case "inscription":

                $authController = new AuthController();

                if ($this->method === "GET") {
                    $authController->getSignUpPage();
                } elseif ($this->method === "POST") {
                    $authController->signUp();
                }
                break;

            case "mon_compte":
                $myAccountController = new MyAccountController();

                if ($this->method === "GET") {
                    $myAccountController->getMyAccountPage();
                } elseif ($this->method === "POST") {
                    if (isset($_GET['action']) && $_GET['action'] === 'editUserInformations') {

                        $myAccountController->editUserInformation();
                    } elseif (isset($_GET['action']) && $_GET['action'] === 'editUserAvatar') {
                        $myAccountController->editUserAvatar();
                    }
                }
                break;

            case "ajouter_un_livre":
                if ($this->method === "GET") {
                    // $myAccountController->getMyAccountPage();
                } elseif ($this->method === "POST") {
                }


            case "deconnexion":

                $authController = new AuthController();
                $authController->logout();
        }
    }
}
