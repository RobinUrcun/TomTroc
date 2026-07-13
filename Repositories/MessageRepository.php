<?php

class MessageRepository
{
    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->getPDO();
    }

    public function create(string $content, int $user_id, int $discussion_id)
    {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO messages (content, send_at, from_user_id, discussion_id, is_read) VALUES (:content, :send_at, :from_user_id, :discussion_id, :is_read)");

            $status = $stmt->execute([
                ":content" => $content,
                ":send_at" =>  date('Y-m-d H:i:s'),
                ":from_user_id" => $user_id,
                ":discussion_id" => $discussion_id,
                ":is_read" => 0
            ]);

            if (!$status) {
                throw new Exception("Erreur d'enregistrement");
            }
        } catch (Exception $e) {
            throw new Exception("Erreur d'enregistrement");
        }
    }

    public function getMessagesByDiscussionId(int $discussion_id, int $user_id): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM messages WHERE discussion_id = :discussion_id ORDER BY send_at ASC");

        $stmt->execute([
            ":discussion_id" => $discussion_id
        ]);

        $results =  $stmt->fetchAll();

        $messages_list = [];

        foreach ($results as $result) {
            $message = new Message();
            $message->setId($result["id"]);
            $message->setContent($result["content"]);
            $message->setSendAt(new DateTime($result["send_at"]));
            $message->setFromUserId($result["from_user_id"]);
            $message->setIsRead($result["is_read"]);

            if ($message->getFromUserId() !== $user_id && !$message->getIsRead()) {
                try {
                    $this->markAsRead($message->getId());
                    $message->setIsRead(true);
                } catch (Exception $e) {
                    Redirect::to("404");
                }
            }
            $messages_list[] = $message;
        }

        return $messages_list;
    }

    public function getLastMessage(int $discussion_id): ?Message
    {
        $stmt = $this->pdo->prepare("SELECT * from messages WHERE discussion_id = :discussion_id ORDER BY send_at DESC LIMIT 1");

        $stmt->execute([
            ":discussion_id" => $discussion_id
        ]);

        $result = $stmt->fetch();

        if (!$result) {
            return null;
        }

        $message = new Message();
        $message->setId($result["id"]);
        $message->setContent($result["content"]);
        $message->setSendAt(new DateTime($result["send_at"]));
        $message->setFromUserId($result["from_user_id"]);
        $message->setIsRead($result["is_read"]);

        return $message;
    }

    public function getUnreadMessagesCount(int $userId): int
    {
        $stmt = $this->pdo->prepare("SELECT discussions.id FROM user_discussion INNER JOIN discussions ON user_discussion.discussion_id = discussions.id WHERE user_discussion.user_id = :user_id");

        $stmt->execute([
            ":user_id" => $userId
        ]);

        $results = $stmt->fetchAll();

        $counter = 0;


        foreach ($results as $result) {

            $lastMessage = $this->getLastMessage($result["id"]);

            if (!$lastMessage->getIsRead() && $lastMessage->getFromUserId() !== $userId) {
                $counter++;
            }
        }

        return $counter;
    }

    private function markAsRead(int $message_id)
    {
        $stmt = $this->pdo->prepare("UPDATE messages SET is_read = 1 WHERE id = :message_id");

        $result = $stmt->execute([
            ":message_id" => $message_id
        ]);

        if (!$result) {
            throw new Exception();
        }
    }
}
