<?php

class Book
{

    private string $id;
    private string $title;
    private string $author;
    private string $comment;
    private string $disponibility;
    private string $image_file_name;
    private int $user_id;
    private DateTime $created_at;

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle(string $title)
    {
        $this->title = $title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor(string $author)
    {
        $this->author = $author;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function setComment(string $comment)
    {
        $this->comment = $comment;
    }

    public function getDisponibility()
    {
        return $this->disponibility;
    }

    public function setDisponibility(string $disponibility)
    {
        $this->disponibility = $disponibility;
    }

    public function getImageFileName()
    {
        return $this->image_file_name;
    }

    public function setImageFileName(string $image_file_name)
    {
        $this->image_file_name = $image_file_name;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
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
