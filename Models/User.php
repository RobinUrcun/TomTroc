<?php

class User
{

    private string $id;
    private string $pseudo;
    private string $mail;
    private string $password;
    private string $avatar_file_name;
    public array $books;
    private DateTime $created_at;


    public function __construct() {}

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail(string $mail)
    {
        $this->mail = $mail;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getAvatarFileName()
    {
        return $this->avatar_file_name;
    }

    public function setAvatarFileName(string $avatar_file_name)
    {
        $this->avatar_file_name = $avatar_file_name;
    }

    public function getBooks(): array
    {

        return $this->books;
    }

    public function setBooks(array $books)
    {
        $this->books = $books;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt(DateTime $created_at)
    {
        $this->created_at = $created_at;
    }
}
