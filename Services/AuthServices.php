<?php

class AuthServices
{

    public function verifyCredentials(string $mail, string $password): User
    {

        $userRepository = new UserRepository();

        try {
            $user = $userRepository->getByMail($mail);
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

        $userRepository = new UserRepository();

        $user = $userRepository->getById($userId);

        if (!$user) {
            return null;
        }

        return $user;
    }
}
