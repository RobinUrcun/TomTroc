<?php

class Message
{

    private int $id;
    private string $content;
    private DateTime $sendAt;
    private string $fromUserId;
    private bool $isRead;

    public function getId()
    {
        return (int) $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent(string $content)
    {
        $this->content = $content;
    }

    public function getSendAt()
    {
        return $this->sendAt;
    }

    public function setSendAt(DateTime $sendAt)
    {
        $this->sendAt = $sendAt;
    }

    public function getFromUserId()
    {
        return (int) $this->fromUserId;
    }

    public function setFromUserId(int $fromUserId)
    {
        $this->fromUserId = $fromUserId;
    }


    public function getIsRead()
    {
        return $this->isRead;
    }

    public function setIsRead(bool $isRead)
    {
        $this->isRead = $isRead;
    }
}
