<?php

class MyAccountController
{

    public function handle()
    {
        $user = AuthServices::getAuthenticatedUser();

        if (!$user) {
            Redirect::to("connexion");
        }

        $method = $_SERVER["REQUEST_METHOD"];

        if ($method === "GET") {
            $title = "Mon compte";
            require_once(__DIR__ . "/../Views/my_account.php");
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

                $title = "Mon compte";
                require_once(__DIR__ . "/../Views/my_account.php");
                return;
            }

            $isMailUnique = FormValidation::IsMailUnique($mail);
            $isPseudoUnique = FormValidation::IsPseudoUnique($pseudo);

            if (($user->getMail() !== $mail) && !$isMailUnique) {
                $inputErrorManager->setMailError("Adresse email déjà utilisée");
            }
            if (($user->getPseudo() !== $pseudo) && !$isPseudoUnique) {
                $inputErrorManager->setPseudoError("Pseudo déjà utilisé");
            }

            if ((($user->getMail() !== $mail) && !$isMailUnique) || (($user->getPseudo() !== $pseudo) && !$isPseudoUnique)) {
                $title = "Mon compte";
                $previousPseudo = $pseudo;
                $previousMail = $mail;
                require_once(__DIR__ . "../../Views/my_account.php");
                return;
            }

            try {
                $userManager = new UserManager();
                $user = $userManager->update($user->getId(), $pseudo, $mail, $password);
            } catch (Exception $e) {
                Redirect::to("404");
                return;
            }

            SessionService::setUser($user);
            Redirect::to("mon_compte");
        }
    }
}
