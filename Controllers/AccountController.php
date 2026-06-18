<?php

class AccountController
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

            $title = "Mon compte";
            require_once(__DIR__ . "/../Views/my_account.php");
            return;
        }

        $isMailUnique = FormValidation::IsMailUnique($mail);
        $isPseudoUnique = FormValidation::IsPseudoUnique($pseudo);

        if (($user->getMail() !== $mail) && !$isMailUnique) {
            $accountErrorManager->setMailError("Adresse email déjà utilisée");
        }
        if (($user->getPseudo() !== $pseudo) && !$isPseudoUnique) {
            $accountErrorManager->setPseudoError("Pseudo déjà utilisé");
        }

        if ((($user->getMail() !== $mail) && !$isMailUnique) || (($user->getPseudo() !== $pseudo) && !$isPseudoUnique)) {
            $title = "Mon compte";
            $previousPseudo = $pseudo;
            $previousMail = $mail;
            require_once(__DIR__ . "../../Views/my_account.php");
            return;
        }

        try {
            $userRepository = new UserRepository();
            $user = $userRepository->updateUserInformation($user->getId(), $pseudo, $mail, $password);
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

        $user = $this->user;

        if (!$file) {
            $accountErrorManager = new AccountErrorManager();
            $accountErrorManager->setFileError("Aucun fichier");
            $title = "Mon compte";
            require_once(__DIR__ . "../../Views/my_account.php");
            return;
        }

        try {
            $fileManager = new FileManager($file);
        } catch (Error $e) {
            $accountErrorManager = new AccountErrorManager();
            $accountErrorManager->setFileError($e->getMessage());
            $title = "Mon compte";
            require_once(__DIR__ . "../../Views/my_account.php");
            return;
        }

        if (!FormValidation::isFileSizeCorrect($fileManager->size)) {
            $accountErrorManager = new AccountErrorManager();
            $accountErrorManager->setFileError("La taille du fichier ne doit pas exceder 5 Mo");
            $title = "Mon compte";
            require_once(__DIR__ . "../../Views/my_account.php");
            return;
        }

        $mappingFileMimeType = [
            "image/jpeg" => "jpg",
            "image/png"  => "png",
            "image/webp" => "webp",
        ];

        if (!isset($mappingFileMimeType[$fileManager->mimeType])) {
            $accountErrorManager = new AccountErrorManager();
            $accountErrorManager->setFileError("le fichier doit etre du type png ou jpeg ou webp");
            $title = "Mon compte";
            require_once(__DIR__ . "../../Views/my_account.php");
            return;
        }

        $fileName = uniqid() . "." . $mappingFileMimeType[$fileManager->mimeType];

        unlink(__DIR__ . "/../Public/Uploads/Avatars/" . $user->getAvatarFileName());

        move_uploaded_file($file["tmp_name"], __DIR__ . "/../Public/Uploads/Avatars/" . $fileName);

        $userRepository = new UserRepository();
        try {

            $userRepository->updateUserAvatar($user->getId(), $fileName);
        } catch (Error $e) {
            Redirect::to("404");
            return;
        }

        Redirect::to("mon_compte");
    }
}
