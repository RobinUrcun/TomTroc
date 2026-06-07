<?php

class UserRepository
{

    public PDO $pdo;

    public function __construct()
    {

        $this->pdo = (new Database())->getPDO();
    }

    public function create(string $pseudo, string $mail, string $password): User
    {

        try {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $this->pdo->prepare("INSERT INTO users (pseudo, mail, password, avatar_file_name, created_at) VALUES (:pseudo, :mail, :password, :avatar_file_name, :created_at)");

            $status = $stmt->execute([
                ":pseudo" => $pseudo,
                ":mail" => $mail,
                ":password" => $hashed_password,
                ":avatar_file_name" => "default_user_avatar.webp",
                ":created_at" => date('Y-m-d')
            ]);

            if (!$status) {
                throw new Exception();
            }

            $user = $this->getByMail($mail);
            return $user;
        } catch (Exception $e) {
            throw new Exception();
        }
    }

    public function updateUserInformation(int $userId, string $pseudo, string $mail, string $password): User
    {

        try {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $this->pdo->prepare("UPDATE users SET pseudo=:pseudo, mail=:mail, password=:password WHERE id=:userId");

            $status = $stmt->execute([
                ":pseudo" => $pseudo,
                ":mail" => $mail,
                ":password" => $hashed_password,
                ":userId" => $userId
            ]);

            if (!$status) {
                throw new Exception();
            }

            $user = $this->getByMail($mail);
            return $user;
        } catch (Exception $e) {
            throw new Exception();
        }
    }

    public function updateUserAvatar(int $userId, string $avatarFileName): User
    {

        try {
            $stmt = $this->pdo->prepare("UPDATE users SET avatar_file_name=:avatar_file_name WHERE id=:userId");

            $status = $stmt->execute([
                ":avatar_file_name" => $avatarFileName,
                ":userId" => $userId
            ]);

            if (!$status) {
                throw new Exception();
            }

            $user = $this->getById($userId);
            return $user;
        } catch (Error $e) {
            throw new Error();
        }
    }

    public function getById(int $id): User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id=:id");

        $stmt->execute([':id' => $id]);

        $result = $stmt->fetch();

        if (!$result) {
            throw new Exception();
        }

        $user = new User();

        $user->setId($result["id"]);
        $user->setPseudo($result["pseudo"]);
        $user->setMail($result["mail"]);
        $user->setPassword($result["password"]);
        $user->setAvatarFileName($result["avatar_file_name"]);
        $user->setCreatedAt(new DateTime($result["created_at"]));

        return $user;
    }

    public function getByMail(string $mail): User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE mail=:mail");

        $stmt->execute([":mail" => $mail]);

        $result = $stmt->fetch();

        if (!$result) {
            throw new Exception();
        }

        $user = new User();

        $user->setId($result["id"]);
        $user->setPseudo($result["pseudo"]);
        $user->setMail($result["mail"]);
        $user->setPassword($result["password"]);
        $user->setAvatarFileName($result["avatar_file_name"]);
        $user->setCreatedAt(new DateTime($result["created_at"]));
        return $user;
    }

    public function getByPseudo(string $pseudo): User
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE pseudo=:pseudo");

        $stmt->execute([":pseudo" => $pseudo]);

        $result = $stmt->fetch();

        if (!$result) {
            throw new Exception();
        }

        $user = new User();

        $user->setId($result["id"]);
        $user->setPseudo($result["pseudo"]);
        $user->setMail($result["mail"]);
        $user->setPassword($result["password"]);
        $user->setAvatarFileName($result["avatar_file_name"]);
        $user->setCreatedAt(new DateTime($result["created_at"]));
        return $user;
    }
}
