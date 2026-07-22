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

                $controller = new BookController();
                $controller->getOurBookPage();
                break;

            case "livre":

                $controller = new BookController();
                $controller->getBookPage();
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
                $accountController = new AccountController();

                if ($this->method === "GET") {
                    $accountController->getMyAccountPage();
                } elseif ($this->method === "POST") {
                    if (isset($_GET['action']) && $_GET['action'] === 'editUserInformations') {

                        $accountController->editUserInformation();
                    } elseif (isset($_GET['action']) && $_GET['action'] === 'editUserAvatar') {
                        $accountController->editUserAvatar();
                    }
                }
                break;

            case "compte_utilisateur":
                $accountController = new AccountController();

                $accountController->getUserAccountPage();
                break;


            case "ajouter_un_livre":

                $booksManagerController = new BooksManagerController();
                if ($this->method === "GET") {
                    $booksManagerController->getCreateBookPage();
                } elseif ($this->method === "POST") {
                    $booksManagerController->create();
                }

                break;

            case "modifier_un_livre":

                $booksManagerController = new BooksManagerController();
                if ($this->method === "GET") {
                    $booksManagerController->getUpdateBookPage();
                } elseif ($this->method === "POST") {
                    $booksManagerController->update();
                }

                break;

            case "supprimer_un_livre":

                $booksManagerController = new BooksManagerController();
                if ($this->method === "GET") {
                    $booksManagerController->deleteBook();
                } elseif ($this->method === "POST") {
                    Redirect::to("404");
                }

                break;

            case "messagerie":

                $messagerieController = new MessagingController();

                if ($this->method === "GET") {
                    $target_user_id = isset($_GET["utilisateur_id"]) ? (int) $_GET["utilisateur_id"] : null;
                    if ($target_user_id) {
                        $messagerieController->getMessagingWithUserPage($target_user_id);
                    } else {
                        $messagerieController->getMessagingPage();
                    }
                } elseif ($this->method === "POST") {
                    $messagerieController->sendMessage();
                }


                break;



            case "deconnexion":

                $authController = new AuthController();
                $authController->logout();
                break;


            case "404":
                $errorController = new ErrorController();
                $errorController->getErrorPage();
                break;

            default:
                $errorController = new ErrorController();
                $errorController->getErrorPage();
                break;
        }
    }
}
