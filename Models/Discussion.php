<?php

class Discussion
{
    private string $id;
    private array $messagesList;
    private ?Message $lastMessage;
    private User $targetUser;

    public function getId()
    {
        return (int) $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getLastMessage()
    {
        return $this->lastMessage;
    }

    public function setLastMessage(?Message $lastMessage)
    {
        $this->lastMessage = $lastMessage;
    }

    public function getMessagesList()
    {
        return $this->messagesList;
    }

    public function setMessagesList(?array $messagesList)
    {
        $this->messagesList = $messagesList;
    }

    public function getTargetUser()
    {
        return $this->targetUser;
    }

    public function setTargetUser(User $targetUser)
    {
        $this->targetUser = $targetUser;
    }
}
