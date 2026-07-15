<?php

class AuthController
{


    public function __construct()
    {
        $user = AuthServices::getAuthenticatedUser();

        if ($user) {
            Redirect::to("accueil");
            return;
        }
    }

    public function getLoginPage()
    {
        $title = "Connexion";
        require_once(__DIR__ . "/../Views/login.php");
    }

    public function login()
    {
        $mail = isset($_POST["mail"]) ? $_POST["mail"] : null;
        $password = isset($_POST["password"]) ? $_POST["password"] : null;

        $accountErrorManager = new AccountErrorManager();
        try {
            FormValidation::isMailValid($mail);
        } catch (Exception $e) {
            $accountErrorManager->setMailError($e->getMessage());
        }

        try {
            FormValidation::isPasswordValid($password);
        } catch (Exception $e) {
            $accountErrorManager->setPasswordError($e->getMessage());
        }

        if ($accountErrorManager->isMailError || $accountErrorManager->isPasswordError) {
            $title = "Connexion";
            $previousMail = $mail;

            require_once(__DIR__ . "/../Views/login.php");
            return;
        }

        try {
            $authService = new AuthServices();
            $user = $authService->verifyCredentials($mail, $password);
        } catch (Exception $e) {

            $title = "Connexion";
            $previousMail = $mail;
            $accountErrorManager->isInvalidCredentials = true;

            require_once(__DIR__ . "/../Views/login.php");
            return;
        }

        SessionService::setUser($user);

        Redirect::to("accueil");
        return;
    }

    public function getSignUpPage()
    {
        $title = "Inscription";
        require_once(__DIR__ . "/../Views/signup.php");
    }

    public function signUp()
    {
        $pseudo = isset($_POST["pseudo"]) ? $_POST["pseudo"] : null;
        $mail = isset($_POST["mail"]) ? $_POST["mail"] : null;
        $password = isset($_POST["password"]) ? $_POST["password"] : null;

        $accountErrorManager = new AccountErrorManager();
        try {
            FormValidation::isPseudoValid($pseudo);
        } catch (Exception $e) {
            $accountErrorManager->setPseudoError($e->getMessage());
        }
        try {
            FormValidation::isMailValid($mail);
        } catch (Exception $e) {
            $accountErrorManager->setMailError($e->getMessage());
        }
        try {
            FormValidation::isPasswordValid($password);
        } catch (Exception $e) {
            $accountErrorManager->setPasswordError($e->getMessage());
        }

        if ($accountErrorManager->isMailError || $accountErrorManager->isPasswordError || $accountErrorManager->isPseudoError) {
            $title = "Inscription";
            $previousPseudo = $pseudo;
            $previousMail = $mail;
            require_once(__DIR__ . "/../Views/signup.php");
            return;
        }

        $isMailUnique = FormValidation::IsMailUnique($mail);
        $isPseudoUnique = FormValidation::IsPseudoUnique($pseudo);

        if (!$isMailUnique) {
            $accountErrorManager->setMailError("Adresse email déjà utilisée");
        }
        if (!$isPseudoUnique) {
            $accountErrorManager->setPseudoError("Pseudo déjà utilisé");
        }

        if (!$isMailUnique || !$isPseudoUnique) {
            $title = "Inscription";
            $previousPseudo = $pseudo;
            $previousMail = $mail;
            require_once(__DIR__ . "/../Views/signup.php");
            return;
        }

        try {
            $userRepository = new UserRepository();
            $user = $userRepository->create($pseudo, $mail, $password);
        } catch (Exception $e) {
            Redirect::to("404");
            return;
        }

        SessionService::setUser($user);
        Redirect::to("accueil");
        return;
    }

    public function logout()
    {
        SessionService::deleteUserId();
        Redirect::to("accueil");
        return;
    }
}
