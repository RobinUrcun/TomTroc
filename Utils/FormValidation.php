<?php

class FormValidation
{

    public static function isPseudoValid(?string $pseudo)
    {
        if (!$pseudo) {
            throw new Exception("Le pseudo est requis");
        } elseif (strlen($pseudo) < 5) {
            throw new Exception("Le pseudo est doit faire minimum 5 caractères");
        }
    }

    public static function isMailValid(?string $mail)
    {

        if (!$mail) {
            throw new Exception("Le mail est requis");
        }
    }

    public static function isPasswordValid(?string $password)
    {

        if (!$password) {
            throw new Exception("Le mot de passse est requis");
        } elseif (strlen($password) < 8) {
            throw new Exception("Le mot de passse est doit faire minimum 8 caractères");
        }
    }

    public static function IsMailUnique(string $mail, ?int $id = null): bool
    {
        $userManager = new UserManager();
        try {
            $user = $userManager->getByMail($mail);
            return false;
        } catch (Exception $e) {
            return true;
        }
    }

    public static function IsPseudoUnique(string $pseudo): bool
    {
        $userManager = new UserManager();
        try {
            $user = $userManager->getByPseudo($pseudo);
            return false;
        } catch (Exception $e) {
            return true;
        }
    }
}
