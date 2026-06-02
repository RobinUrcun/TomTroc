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
                $controller->handle();
                break;

            case "nos_livres":

                $controller = new OurBookController();
                $controller->handle();
                break;

            case "connexion":

                $authController = new AuthController();
                $authController->login();

                break;


            case "inscription":

                $authController = new AuthController();
                $authController->signup();
                break;

            case "mon_compte":
                $myAccountController = new MyAccountController();
                $myAccountController->handle();
                break;

            case "deconnexion":

                $authController = new AuthController();
                $authController->logout();
        }
    }
}
