<?php

class AuthController
{

    public function login()
    {
        $user = AuthServices::getAuthenticatedUser();

        if ($user) {
            Redirect::to("accueil");
            return;
        }

        $method = $_SERVER["REQUEST_METHOD"];


        if ($method === "GET") {
            $title = "Connexion";
            require_once(__DIR__ . "/../Views/login.php");
            return;
        } elseif ($method === "POST") {
            $mail = isset($_POST["mail"]) ? $_POST["mail"] : null;
            $password = isset($_POST["password"]) ? $_POST["password"] : null;

            $inputErrorManager = new InputErrorManager();
            try {
                FormValidation::isMailValid($mail);
            } catch (Exception $e) {
                $inputErrorManager->setMailError($e->getMessage());
            }

            try {
                FormValidation::isPasswordValid($password);
            } catch (Exception $e) {
                $inputErrorManager->setPasswordError($e->getMessage());
            }

            if ($inputErrorManager->isMailError || $inputErrorManager->isPasswordError) {
                $title = "Connexion";
                $previousMail = $mail;

                require_once(__DIR__ . "../../Views/login.php");
                return;
            }

            try {
                $authService = new AuthServices();
                $user = $authService->verifyCredentials($mail, $password);
            } catch (Exception $e) {

                $title = "Connexion";
                $previousMail = $mail;
                $inputErrorManager->isInvalidCredentials = true;

                require_once(__DIR__ . "../../Views/login.php");
                return;
            }

            SessionService::setUser($user);

            Redirect::to("accueil");
        }
    }

    public function signUp()
    {
        $user = AuthServices::getAuthenticatedUser();

        if ($user) {
            Redirect::to("accueil");
            return;
        }

        $method = $_SERVER["REQUEST_METHOD"];

        if ($method === "GET") {
            $title = "Inscription";
            require_once(__DIR__ . "/../Views/signup.php");
            return;
        } elseif ($method === "POST") {

            $pseudo = isset($_POST["pseudo"]) ? $_POST["pseudo"] : null;
            $mail = isset($_POST["mail"]) ? $_POST["mail"] : null;
            $password = isset($_POST["password"]) ? $_POST["password"] : null;

            $inputErrorManager = new InputErrorManager();
            try {
                FormValidation::isPseudoValid($pseudo);
            } catch (Exception $e) {
                $inputErrorManager->setPseudoError($e->getMessage());
            }
            try {
                FormValidation::isMailValid($mail);
            } catch (Exception $e) {
                $inputErrorManager->setMailError($e->getMessage());
            }
            try {
                FormValidation::isPasswordValid($password);
            } catch (Exception $e) {
                $inputErrorManager->setPasswordError($e->getMessage());
            }

            if ($inputErrorManager->isMailError || $inputErrorManager->isPasswordError || $inputErrorManager->isPseudoError) {
                $title = "Inscription";
                $previousPseudo = $pseudo;
                $previousMail = $mail;
                require_once(__DIR__ . "../../Views/signup.php");
                return;
            }

            $isMailUnique = FormValidation::IsMailUnique($mail);
            $isPseudoUnique = FormValidation::IsPseudoUnique($pseudo);

            if (!$isMailUnique) {
                $inputErrorManager->setMailError("Adresse email déjà utilisée");
            }
            if (!$isPseudoUnique) {
                $inputErrorManager->setPseudoError("Pseudo déjà utilisé");
            }

            if (!$isMailUnique || !$isPseudoUnique) {
                $title = "Inscription";
                $previousPseudo = $pseudo;
                $previousMail = $mail;
                require_once(__DIR__ . "../../Views/signup.php");
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
        }
    }

    public function logout()
    {
        SessionService::deleteUserId();
        Redirect::to("accueil");
    }
}
