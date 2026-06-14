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

    public function update(string $title, string $author, string $comment, string $disponibility, string $imageFileName, int $bookId)
    {
        try {
            $stmt = $this->pdo->prepare("UPDATE books SET title=:title, author=:author, comment=:comment, disponibility=:disponibility, image_file_name=:image_file_name WHERE id=:book_id");

            $status = $stmt->execute([
                ":title" => $title,
                ":author" => $author,
                ":comment" => $comment,
                ":disponibility" => $disponibility,
                ":image_file_name" => $imageFileName,
                ":book_id" => $bookId


            ]);

            if (!$status) {
                throw new Exception();
            }

            return;
        } catch (Exception $e) {
            throw new Exception();
        }
    }

    public function getById(int $id): Book | null
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id=:id;");
            $stmt->execute([
                ":id" => $id
            ]);

            $result = $stmt->fetch();

            if (!$result) {
                return null;
            }

            $book = new Book();

            $book->setId($result["id"]);
            $book->setTitle($result["title"]);
            $book->setAuthor($result["author"]);
            $book->setComment($result["comment"]);
            $book->setDisponibility($result["disponibility"]);
            $book->setImageFileName($result["image_file_name"]);
            $book->setCreatedAt(new DateTime($result["created_at"]));

            return $book;
        } catch (Exception $e) {
            throw new Exception();
        }
    }

    public function delete(int $bookId): void
    {
        try {
            $stmt = $this->pdo->prepare("DELETE from books WHERE id=:id;");

            $status = $stmt->execute([":id" => $bookId]);

            if (!$status) {
                throw new Exception();
                return;
            }
        } catch (Exception $e) {
            throw new Exception();
        }
    }

    public function get(?int $quantity = null): array
    {
        $sql = "SELECT books.*, users.pseudo AS user_pseudo FROM books JOIN users ON books.user_id = users.id ORDER BY books.created_at DESC";

        if ($quantity) {
            $sql .= " LIMIT $quantity";
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute();

        $results = $stmt->fetchAll();

        if (!$results) {
            throw new Exception();
        }

        $books = [];

        foreach ($results as $book) {
            $newBook = new Book();

            $newBook = new Book();
            $newBook->setId($book["id"]);
            $newBook->setTitle($book["title"]);
            $newBook->setAuthor($book["author"]);
            $newBook->setComment($book["comment"]);
            $newBook->setDisponibility($book["disponibility"]);
            $newBook->setImageFileName($book["image_file_name"]);
            $newBook->setCreatedAt(new DateTime($book["created_at"]));

            $user = new User();

            $user->setPseudo($book["user_pseudo"]);

            $newBook->setUser($user);

            $books[] = $newBook;
        }

        return $books;
    }
}
