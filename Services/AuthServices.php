<?php

class AuthServices
{

    public function verifyCredentials(string $mail, string $password): User
    {

        $userManager = new UserManager();

        try {
            $user = $userManager->getByMail($mail);
        } catch (Exception $e) {

            throw new Exception();
        }

        if (!password_verify($password, $user->getPassword())) {
            throw new Exception();
        }

        return $user;
    }



    public static function getAuthenticatedUser(): ?User
    {
        $userId = SessionService::getUserId();

        if (!$userId) {
            return null;
        }

        $userManager = new UserManager();

        $user = $userManager->getById($userId);

        if (!$user) {
            return null;
        }

        return $user;
    }
}
