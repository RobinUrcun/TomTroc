<?php

class MyAccountController
{
    private ?User $user;

    public function __construct()
    {
        $this->user = AuthServices::getAuthenticatedUser();

        if (!$this->user) {
            Redirect::to("connexion");
        }
    }

    public function getMyAccountPage()
    {
        $user = $this->user;
        $title = "Mon compte";
        require_once(__DIR__ . "/../Views/my_account.php");
    }


    public function editUserInformation()
    {

        $user = $this->user;

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
            $user = $userManager->updateUserInformation($user->getId(), $pseudo, $mail, $password);
        } catch (Exception $e) {
            Redirect::to("404");
            return;
        }

        SessionService::setUser($user);
        Redirect::to("mon_compte");
    }

    public function editUserAvatar()
    {
        $file = isset($_FILES["avatar"]) ? $_FILES["avatar"] : null;

        if (!$file) {
            $inputErrorManager = new InputErrorManager();
            $inputErrorManager->setFileError("Aucun fichier");
            $title = "Mon compte";
            require_once(__DIR__ . "../../Views/my_account.php");
            return;
        }

        try {
            $fileManager = new FileManager($file);
        } catch (Error $e) {
            $inputErrorManager = new InputErrorManager();
            $inputErrorManager->setFileError($e->getMessage());
            $title = "Mon compte";
            require_once(__DIR__ . "../../Views/my_account.php");
            return;
        }

        if (!FormValidation::isFileSizeCorrect($fileManager->size)) {
            $inputErrorManager = new InputErrorManager();
            $inputErrorManager->setFileError("La taille du fichier ne doit pas exceder 5 Mo");
            $title = "Mon compte";
            require_once(__DIR__ . "../../Views/my_account.php");
            return;
        }

        $mappingFileMimeType = [
            "image/jpeg" => "jpg",
            "image/png"  => "png",
            "image/webp" => "webp",
        ];

        if (!isset($mappingFileMimeType[$mimeType])) {
            $inputErrorManager = new InputErrorManager();
            $inputErrorManager->setFileError("le fichier doit etre du type png ou jpeg ou webp");
            $title = "Mon compte";
            require_once(__DIR__ . "../../Views/my_account.php");
            return;
        }

        $fileName = $this->user->getPseudo() . $this->user->getId() . "." . $mappingFileMimeType[$fileManager->mimeType];

        move_uploaded_file($_FILES["avatar"]["tmp_name"], __DIR__ . "/../Public/Uploads/" . $fileName);

        $userManager = new UserManager();
    }
}
