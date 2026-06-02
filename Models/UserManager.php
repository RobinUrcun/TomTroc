<?php

class UserManager
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

            $stmt = $this->pdo->prepare("INSERT INTO users (pseudo, mail, password) VALUES (:pseudo, :mail, :password)");

            $status = $stmt->execute([
                ":pseudo" => $pseudo,
                ":mail" => $mail,
                ":password" => $hashed_password
            ]);

            if ($status) {
                throw new Exception();
            }

            $user = $this->getByMail($mail);
            return $user;
        } catch (Exception $e) {
            throw new Exception();
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

        return $user;
    }
}
