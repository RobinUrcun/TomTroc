<?php


class SessionService
{

    public static function setUser(User $user): void
    {
        $_SESSION["userId"] = $user->getId();
    }

    public static function getUserId(): ?int
    {
        return $_SESSION["userId"] ?? null;
    }

    public static function deleteUserId(): void
    {
        unset($_SESSION["userId"]);
    }
}
