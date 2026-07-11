<?php

class FormValidation
{

    public static function isPseudoValid(?string $pseudo)
    {
        if (!$pseudo) {
            throw new Exception("Le pseudo est requis");
        } elseif (strlen($pseudo) < 5) {
            throw new Exception("Le pseudo doit faire minimum 5 caractères");
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
            throw new Exception("Le mot de passe  doit faire minimum 8 caractères");
        }
    }

    public static function IsMailUnique(string $mail): bool
    {
        $userRepository = new UserRepository();
        try {
            $user = $userRepository->getByMail($mail);
            return false;
        } catch (Exception $e) {
            return true;
        }
    }

    public static function IsPseudoUnique(string $pseudo): bool
    {
        $userRepository = new UserRepository();
        try {
            $user = $userRepository->getByPseudo($pseudo);
            return false;
        } catch (Exception $e) {
            return true;
        }
    }

    public static function isFileSizeCorrect(int $fileSize): bool
    {
        return $fileSize < 5242880;
    }

    public static function isTitleValid(?string $title)
    {
        if (!$title) {
            throw new Exception("Le titre est requis");
        } elseif (strlen($title) < 5) {
            throw new Exception("Le titre doit faire minimum 5 caractères");
        }
    }

    public static function isAuthorValid(?string $author)
    {
        if (!$author) {
            throw new Exception("L'auteur est requis");
        } elseif (strlen($author) < 5) {
            throw new Exception("L'auteur doit faire minimum 5 caractères");
        }
    }

    public static function isCommentValid(?string $comment)
    {
        if (!$comment) {
            throw new Exception("Le commentaire est requis");
        } elseif (strlen($comment) < 5) {
            throw new Exception("Le commentaire  doit faire minimum 5 caractères");
        }
    }

    public static function isDisponibilityValid(?string $disponibility)
    {

        $disponibilityMapping = [
            "available",
            "unavailable"
        ];
        if (!$disponibility) {
            throw new Exception("La disponibilité est requise");
        } elseif (array_key_exists($disponibility, $disponibilityMapping)) {
            throw new Exception("Ce type de disponibilité n'existe pas");
        }
    }

    public static function isMessageContentValid(?string $message_content)
    {
        if ($message_content) {
            if (strlen($message_content) > 1000) {
                throw new Exception("Le message ne doit pas exceder 1000 caractères");
            }
        }
    }
}
