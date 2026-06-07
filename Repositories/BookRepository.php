<?php

class BookRepository
{
    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->getPDO();
    }

    public function create(string $title, string $author, string $comment, string $disponibility, int $userId, string $image_file_name)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO books (title, author, comment, disponibility, image_file_name, user_id, created_at) VALUES (:title, :author, :comment, :disponibility, :image_file_name,:user_id, :created_at)");
            echo "toto";
            $status = $stmt->execute([
                ":title" => $title,
                ":author" => $author,
                ":comment" => $comment,
                ":disponibility" => $disponibility,
                ":image_file_name" => $image_file_name,
                ":user_id" => $userId,
                ":created_at" => date('Y-m-d H:i:s')
            ]);

            if (!$status) {
                throw new Exception();
            }
        } catch (Error $e) {
            throw new Exception();
        }
    }
}
